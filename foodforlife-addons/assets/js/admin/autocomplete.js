(function ($) {
    'use strict';

    var ControlFMautocomplete = elementor.modules.controls.BaseData.extend({
        onReady: function () {

            this.foodforlifeAutocomplete(this);

            this.foodforlifeRemoveData(this);

            this.foodforlifeSortable(this);

            this.foodforlifeOnRender(this);
        },
        foodforlifeAutocomplete: function (self) {
            var $input_value = self.$el.find('.foodforlife_autocomplete_value'),
                self_value = $input_value.val(),
                multiple = $input_value.data('multiple'),
                step = '',
                item_value = '';

            self.$el.find('.foodforlife_autocomplete_param').autocomplete({
                minLength: 1,
                source: function (request, response) {
                    $.ajax({
                        url: ajaxurl,
                        dataType: 'json',
                        method: 'post',
                        data: {
                            action: 'foodforlife_get_autocomplete_suggest',
                            term: request.term,
                            source: $input_value.data('source')
                        },
                        success: function (data) {
                            response(data.data);
                        }
                    })
                },
                response: function (event, ui) {
                    self.$el.find('.foodforlife_autocomplete').removeClass('loading');
                },
                search: function (event, ui) {
                    self.$el.find('.foodforlife_autocomplete').addClass('loading');
                },
                select: function (event, ui) {

                    item_value = ui.item.value;

                    if (item_value === 'nothing-found') {
                        return false;
                    }
                    self_value = $input_value.val();
                    if (self_value !== '') {
                        step = ',';
                    }

                    var template = '<li class="foodforlife_autocomplete-label" data-value="' + item_value + '">' +
                        '<span class="foodforlife_autocomplete-data">' + ui.item.label + '</span>' +
                        '<a href="#" class="foodforlife_autocomplete-remove">×</a>' +
                        '</li>';

                    if (multiple) {
                        self.$el.find('.foodforlife_autocomplete').append(template);
                        self_value = self_value + step + item_value;
                    } else {
                        if( self.$el.find('.foodforlife_autocomplete .foodforlife_autocomplete-label').length > 0 ) {
                            self.$el.find('.foodforlife_autocomplete .foodforlife_autocomplete-label').replaceWith(template);
                        } else {
                            self.$el.find('.foodforlife_autocomplete').append(template);
                        }
                        self.$el.find('.foodforlife_autocomplete .foodforlife_autocomplete-label').replaceWith(template);
                        self_value = item_value;
                    }

                    self.$el.find('.foodforlife_autocomplete_param').val('');
                    $input_value.val(self_value);
                    self.setValue(self_value);

                    return false;
                },
                open: function (event) {
                    $(event.target).data('uiAutocomplete').menu.activeMenu.addClass('elementor-autocomplete-menu foodforlife-autocomplete-menu');
                }
            }).autocomplete('instance')._renderItem = function (ul, item) {
                return $('<li>')
                    .attr('data-value', item.value)
                    .append(item.label)
                    .appendTo(ul);
            };
            return self_value;
        },
        foodforlifeRemoveData: function (self) {
            var $input_value = self.$el.find( '.foodforlife_autocomplete_value' );
			self.$el.find( '.foodforlife_autocomplete' ).on( 'click', '.foodforlife_autocomplete-remove', function ( e ) {
				e.preventDefault();
				var $this = $( this ),
					self_value = '';

				$this.closest( '.foodforlife_autocomplete-label' ).remove();

				self.$el.find( '.foodforlife_autocomplete' ).find( '.foodforlife_autocomplete-label' ).each( function () {
					self_value = self_value + ',' + $( this ).data( 'value' );
				} );
				$input_value.val(self_value);
                self.setValue( self_value );

            } );


        },
        foodforlifeSortable: function (self) {
            var sortable = self.$el.find('.foodforlife_autocomplete_value').data('sortable'),
                self_value = '';
            if (sortable) {
                self.$el.find('.foodforlife_autocomplete').sortable({
                    items: 'li.foodforlife_autocomplete-label',
                    update: function (event, ui) {

                        self_value = '';

                        self.$el.find('.foodforlife_autocomplete').find('li.foodforlife_autocomplete-label').each(function () {
                            self_value = self_value + ',' + $(this).data('value');
                        });

                        self.setValue(self_value);
                    }
                });
            }
        },
        foodforlifeOnRender: function (self) {
            var $input_value = self.$el.find('.foodforlife_autocomplete_value'),
                self_value = $input_value.val();

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                method: 'post',
                data: {
                    action: 'foodforlife_get_autocomplete_render',
                    term: self_value,
                    source: $input_value.data('source')
                },
                success: function (data) {
                    if (data) {
                        self.$el.find('.foodforlife_autocomplete').append(data.data);
                        self.$el.find('.foodforlife_autocomplete').find('li.foodforlife_autocomplete-loading').remove();
                    }
                }
            });
        },
        onBeforeDestroy: function () {
            if (this.ui.input.data('autocomplete')) {
                this.ui.input.autocomplete('destroy');
            }

            this.$el.remove();
        }
    });
    elementor.addControlView('foodforlife-autocomplete', ControlFMautocomplete);

})
(jQuery);