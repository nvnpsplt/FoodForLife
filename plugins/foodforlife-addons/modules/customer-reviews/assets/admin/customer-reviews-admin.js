jQuery(document).ready(function ($) {
    $('#foodforlife_customer_reviews_upload').on( 'change', function () {
        $('.foodforlife-customer-reviews-upload__message').removeClass( 'error' );
        $('.foodforlife-customer-reviews-upload__message').text( foodforlifeCRA.message );

        let allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

        if( foodforlifeCRA.upload_video ) {
            allowedTypes   = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'video/mp4', 'video/mpeg', 'video/ogg', 'video/webm', 'video/quicktime', 'video/x-msvideo'];
        }

        let uploadFiles    = $('#foodforlife_customer_reviews_upload');
        let countFiles     = uploadFiles[0].files.length;

        for(let i = 0; i < countFiles; i++) {
            if( ! allowedTypes.includes( uploadFiles[0].files[i].type ) ) {
                $('.foodforlife-customer-reviews-upload__message').addClass( 'error' );
                $('.foodforlife-customer-reviews-upload__message').text( foodforlifeCRA.file_type );
                uploadFiles.val('');
                return;
            }
        }
    });

    $( '.foodforlife-customer-reviews-upload__button' ).on( 'click', function(e) {
        e.preventDefault();

        var upload_files = $( '#foodforlife_customer_reviews_upload' );
        var count_files = upload_files[0].files.length;

        if( count_files < 1 ) {
            return;
        }

        var i = 0,
            form_data = new FormData();

        form_data.append( 'action', 'foodforlife_customer_reviews_upload' );
        form_data.append( 'post_id', $(this).attr('data-postid') );
        form_data.append( 'comment_id', $(this).attr('data-commentid') );
        form_data.append( 'foodforlife_nonce', $(this).attr('data-nonce') );
        form_data.append( 'count_files', $('.foodforlife-customer-reviews__items').find('.foodforlife-customer-reviews__item').length );

        for( i = 0; i < count_files; i++ ) {
            form_data.append('files_' + i, upload_files[0].files[i]);
        }

        $.ajax({
            url        : foodforlifeCRA.ajax_url,
            data       : form_data,
            processData: false,
            contentType: false,
            type       : 'POST',
            beforeSend: function() {
                $('.foodforlife-customer-reviews-upload__message').removeClass( 'success' );
                $('.foodforlife-customer-reviews-upload__message').removeClass( 'warning' );
                $('.foodforlife-customer-reviews-upload__message').removeClass( 'error' );
                $('.foodforlife-customer-reviews-upload__message').text( foodforlifeCRA.uploading );

                $('.foodforlife-customer-reviews-upload__button').addClass( 'disabled' );
                $('#foodforlife_customer_reviews_upload').addClass( 'disabled' );
            },
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();

                if ( myXhr.upload ) {
                    myXhr.upload.addEventListener( 'progress', function(e) {
                        if ( e.lengthComputable ) {
                            var perc = ( e.loaded / e.total ) * 100;
                                perc = perc.toFixed(0);

                            $('.foodforlife-customer-reviews-upload__message').text( foodforlifeCRA.uploading + ' (' + perc + '%)' );
                        }
                    }, false );
                }

                return myXhr;
            },
            success: function(response) {
                if( 200 === response['code'] ) {
                    $('.foodforlife-customer-reviews-upload__message').addClass( 'success' );
                } else if( 201 === response['code'] ) {
                    $('.foodforlife-customer-reviews-upload__message').addClass( 'warning' );
                } else {
                    $('.foodforlife-customer-reviews-upload__message').addClass( 'error' );
                }

                $('.foodforlife-customer-reviews-upload__message').text( '' );
                $.each( response['message'], function(index, message) {
                    $('.foodforlife-customer-reviews-upload__message').append( message );
                });

                $('#foodforlife_customer_reviews_upload').val( '' );
                $('.foodforlife-customer-reviews-upload__button').removeClass( 'disabled' );
                $('#foodforlife_customer_reviews_upload').removeClass( 'disabled' );

                if( 'files' in response && response['files'].length > 0 ) {
                    $.each( response['files'], function( index, file ) {
                        let file_html = '';

                        if( 'video' === file['type'] && foodforlifeCRA.upload_video ) {
                            file_html = '<div class="foodforlife-customer-reviews__item foodforlife-customer-reviews__item-' + file['id'] + '" data-type="'+ file['type'] +'">';
                                if ( 'video' === file['type'] ) {
                                    file_html += '<video preload="metadata" class="foodforlife-video" src="' + file['url'] + '"></video>';
                                    file_html += '<span class="foodforlife-svg-icon foodforlife-svg-icon--play foodforlife-customer-reviews__play"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="21" viewBox="0 0 18 21" fill="currentColor"><path d="M18 10.5L0.749999 20.4593L0.75 0.540707L18 10.5Z" fill="currentColor"></path></svg></span>';
                                } else {
                                    file_html += '<img src="' + file['url'] + '" alt="' + file['author'] + '">';
                                }

                                file_html += '<div class="foodforlife-customer-reviews__bg"></div><span class="foodforlife-svg-icon foodforlife-svg-icon--close foodforlife-customer-reviews__detach"><svg aria-hidden="true" role="img" focusable="false" fill="currentColor" width="16" height="16" viewBox="0 0 16 16"><path d="M16 1.4L14.6 0L8 6.6L1.4 0L0 1.4L6.6 8L0 14.6L1.4 16L8 9.4L14.6 16L16 14.6L9.4 8L16 1.4Z" fill="currentColor"></path></svg></span>';
                                file_html += '<div class="foodforlife-customer-reviews__condition hidden"><span class="yes" data-nonce="' + file['nonce'] + '" data-attachment="' + file['id'] + '">'+ foodforlifeCRA.detach_yes +'</span><span class="no">'+ foodforlifeCRA.detach_no +'</span></div>';
                            file_html += '</div>';

                            $( '.foodforlife-customer-reviews__items' ).append( file_html );
                        }
                    });
                }
            }
        });
    });

    $('.foodforlife-customer-reviews__detach').on( 'click', function() {
        $(this).addClass( 'hidden' );
        $(this).closest('.foodforlife-customer-reviews__item').find('.foodforlife-customer-reviews__condition').removeClass( 'hidden' );
    });

    $('.foodforlife-customer-reviews__condition span.no').on( 'click', function() {
        $(this).closest('.foodforlife-customer-reviews__condition').addClass( 'hidden' );
        $(this).closest('.foodforlife-customer-reviews__item').find('.foodforlife-customer-reviews__detach').removeClass( 'hidden' );
    });

    $('.foodforlife-customer-reviews__condition span.yes').on( 'click', function() {
        var data = {
            'action'       : 'foodforlife_customer_reviews_detach',
            'nonce'        : $(this).attr( 'data-nonce' ),
            'comment_id'   : $('.foodforlife-customer-reviews-upload__button').attr( 'data-commentid' ),
            'attachment_id': $(this).attr( 'data-attachment' ),
        };

        $(this).closest('.foodforlife-customer-reviews__item').addClass( 'detached' );
        $.post( foodforlifeCRA.ajax_url, data, function(response) {
            if( response['code'] ) {
                $('.foodforlife-customer-reviews__item-' + response['attachment']).remove();
            } else {
                $('.foodforlife-customer-reviews__items' ).find( '.foodforlife-customer-reviews__item.detached').removeClass( 'detached' );
            }
        });
    });
});
