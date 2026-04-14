jQuery( document ).ready( function( $ ) {
	"use strict";

	var foodforlife = {
		init: function() {
			this.$progress = $( '#foodforlife-demo-import-progress' );
			this.$log = $( '#foodforlife-demo-import-log' );
			this.$importer = $( '#foodforlife-demo-importer' );

			// Events.
			$( document.body )
				.on( 'click', '.foodforlife-tab-nav-wrapper > .nav-tab', foodforlife.switchTabs )
				.on( 'click', '.toggle-options', foodforlife.toggleOptions );


			// Start importing.
			this.startImporting();
		},

		switchTabs: function( event ) {
			event.preventDefault();
			var $tab = $( event.target );

			if ( $tab.hasClass( 'nav-tab-active' ) ) {
				return;
			}

			$tab.addClass( 'nav-tab-active' ).siblings().removeClass( 'nav-tab-active' );

			$( $tab.attr( 'href' ) ).addClass( 'tab-panel-active' ).siblings().removeClass( 'tab-panel-active' );
		},

		toggleOptions: function( event ) {
			event.preventDefault();

			$( event.target ).closest( 'form' ).find( '.demo-import-options' ).stop( true, true ).fadeToggle( 'fast' );
		},

		startImporting: function() {
			if ( ! foodforlife.$importer.length ) {
				return;
			}

			// Collect steps.
			var steps = foodforlife.$importer.find( 'input[name="demo_parts"]' ).val();

			if ( ! steps ) {
				return;
			}

			if ( 'all' === steps ) {
				foodforlife.steps = ['content', 'customizer', 'widgets', 'sliders'];
			} else {
				foodforlife.steps = steps.split( ',' );
			}

			// Check if content is selected.
			foodforlife.containsContent = foodforlife.steps.indexOf( 'content' ) >= 0;

			// Check if need to regenerate images.
			foodforlife.regenImages = !! parseInt( foodforlife.$importer.find( 'input[name="regenerate_images"]' ).val() );

			// Check if this is manually upload.
			foodforlife.isManual = !! parseInt( foodforlife.$importer.find( 'input[name="uploaded"]' ).val() );

			// Let's go.
			if ( foodforlife.isManual ) {
				foodforlife.import( foodforlife.steps.shift() );
			} else {
				foodforlife.download( foodforlife.steps.shift() );
			}
		},

		download: function( type ) {
			foodforlife.log( 'Downloading ' + type + ' file' );

			$.get(
				ajaxurl,
				{
					action: 'foodforlife_download_file',
					type: type,
					demo: foodforlife.$importer.find( 'input[name="demo"]' ).val(),
					uploaded: foodforlife.$importer.find( 'input[name="uploaded"]' ).val(),
					_wpnonce: foodforlife.$importer.find( 'input[name="_wpnonce"]' ).val()
				},
				function( response ) {
					if ( response.success ) {
						foodforlife.import( type );
					} else {
						foodforlife.log( response.data );

						if ( foodforlife.steps.length ) {
							foodforlife.download( foodforlife.steps.shift() );
						} else {
							foodforlife.configTheme();
						}
					}
				}
			).fail( function() {
				foodforlife.log( 'Failed' );
			} );
		},

		import: function( type ) {
			foodforlife.log( 'Importing ' + type );

			var data = {
					action: 'foodforlife_import',
					type: type,
					_wpnonce: foodforlife.$importer.find( 'input[name="_wpnonce"]' ).val()
				};
			var url = ajaxurl + '?' + $.param( data );
			var evtSource = new EventSource( url );

			evtSource.addEventListener( 'message', function ( message ) {
				var data = JSON.parse( message.data );

				switch ( data.action ) {
					case 'updateTotal':
						console.log( data.delta );
						break;

					case 'updateDelta':
						console.log(data.delta);
						break;

					case 'complete':
						evtSource.close();
						foodforlife.log( type + ' has been imported successfully!' );

						if ( foodforlife.steps.length ) {
							if ( foodforlife.isManual ) {
								foodforlife.import( foodforlife.steps.shift() );
							} else {
								foodforlife.download( foodforlife.steps.shift() );
							}
						} else {
							foodforlife.configTheme();
						}

						break;
				}
			} );

			evtSource.addEventListener( 'log', function ( message ) {
				var data = JSON.parse( message.data );
				foodforlife.log( data.message );
			});
		},

		configTheme: function() {
			// Stop if no content imported.
			if ( ! foodforlife.containsContent ) {
				foodforlife.generateImages();
				return;
			}

			$.get(
				ajaxurl,
				{
					action: 'foodforlife_config_theme',
					demo: foodforlife.$importer.find( 'input[name="demo"]' ).val(),
					_wpnonce: foodforlife.$importer.find( 'input[name="_wpnonce"]' ).val()
				},
				function( response ) {
					if ( response.success ) {
						foodforlife.generateImages();
					}

					foodforlife.log( response.data );
				}
			).fail( function() {
				foodforlife.log( 'Failed' );
			} );
		},

		generateImages: function() {
			// Stop if no content imported.
			if ( ! foodforlife.containsContent || ! foodforlife.regenImages ) {
				foodforlife.log( 'Import completed!' );
				foodforlife.$progress.find( '.spinner' ).hide();
				return;
			}

			$.get(
				ajaxurl,
				{
					action: 'foodforlife_get_images',
					_wpnonce: foodforlife.$importer.find( 'input[name="_wpnonce"]' ).val()
				},
				function( response ) {
					if ( ! response.success ) {
						foodforlife.log( response.data );
						foodforlife.log( 'Import completed!' );
						foodforlife.$progress.find( '.spinner' ).hide();
						return;
					} else {
						var ids = response.data;

						if ( ! ids.length ) {
							foodforlife.log( 'Import completed!' );
							foodforlife.$progress.find( '.spinner' ).hide();
						}

						foodforlife.log( 'Starting generate ' + ids.length + ' images' );

						foodforlife.generateSingleImage( ids );
					}
				}
			);
		},

		generateSingleImage: function( ids ) {
			if ( ! ids.length ) {
				foodforlife.log( 'Import completed!' );
				foodforlife.$progress.find( '.spinner' ).hide();
				return;
			}

			var id = ids.shift();

			$.get(
				ajaxurl,
				{
					action: 'foodforlife_generate_image',
					id: id,
					_wpnonce: foodforlife.$importer.find( 'input[name="_wpnonce"]' ).val()
				},
				function( response ) {
					foodforlife.log( response.data + ' (' + ids.length + ' images left)' );

					foodforlife.generateSingleImage( ids );
				}
			);
		},

		log: function( message ) {
			foodforlife.$progress.find( '.text' ).text( message );
			foodforlife.$log.prepend( '<p>' + message + '</p>' );
		}
	};


	foodforlife.init();
} );


const searchInput = document.getElementById("foodforlife-demo-importer-search");

searchInput.addEventListener("input", function () {
	const searchTerm = searchInput.value.toLowerCase();

	const items = document.querySelectorAll(".demo-selector");

	items.forEach(item => {
		const classList = Array.from(item.classList);
		const match = classList.some(cls => cls.toLowerCase().includes(searchTerm));
		console.log(match);
		item.classList.toggle("hidden", !match);
	});
});