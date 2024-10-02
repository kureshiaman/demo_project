jQuery( document ).ready(function( $ ) {
	// Global Var
	var NsForm = $( 'form#ns-form' );
	var EmailFilter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	var ErrorClass = 'ns-error';
	var ErrorElement = 'span';
	var DisabledAttr = 'disabled';

	// Form ErrorElement
	var NsErrorElement = function( InputField ) {
		NsForm.find( InputField ).next( ErrorElement + '.' + ErrorClass ).remove();
		NsForm.find( InputField ).addClass( ErrorClass );
		NsForm.find( InputField ).parent( 'div' ).addClass( 'ns-error-show' );
		span = document.createElement( ErrorElement );
		span.setAttribute( 'class', ErrorClass );
		return span;
	};

	// Form Remove Error
	var NsRemoveError = function ( InputField ) {
		NsForm.find( InputField ).next( ErrorElement + '.' + ErrorClass ).remove();
		NsForm.find( InputField ).parent( 'div' ).removeClass( 'ns-error-show' );
		NsForm.find( InputField ).removeClass( ErrorClass );
	};

	// From Validation
	var Validation = function( nsForm ) {
	var Valid = true;
	// Email Validation
	if ( ! nsForm.find( '#ns-email' ).val() ) {
		$( NsErrorElement( nsForm.find( '#ns-email' ) ) ).text( ajax.email ).insertAfter( NsForm.find( nsForm.find( '#ns-email' ) ) );
		Valid = false;
	} else if ( ! EmailFilter.test( nsForm.find( '#ns-email' ).val() ) ) {
		$( NsErrorElement( nsForm.find( '#ns-email' ) ) ).text( ajax.invalid_email ).insertAfter( NsForm.find( nsForm.find( '#ns-email' ) ) );
		Valid = false;
	} else {
		NsRemoveError( nsForm.find( '#ns-email' ) );
	}

	// First name Validation.
	if ( ! ( nsForm.find( '#ns-firstname' ).val() ) && ( nsForm.find( '#ns-firstname' ).length > 0 ) ) {
		$( NsErrorElement( nsForm.find( '#ns-firstname' ) ) ).text( ajax.firstname_error ).insertAfter( NsForm.find( nsForm.find( '#ns-firstname' ) ) );
		Valid = false;
	} else {
		NsRemoveError( nsForm.find( '#ns-firstname' ) );
	}
	return Valid;
	};

	// Input keypress remove error class.
	NsForm.on( 'keypress', 'input', function( e ) {
		if ( ( e.which == 32 ) && ( $( this ).attr( 'type' ) == "email" ) ) {
			return false;
		}
		NsRemoveError( $( this ) );
	});

	// Ajax submit form
	NsForm.on( 'click', 'input[type="submit"]', function() {
		var _this = $( this );
		var FormData = _this.parents( 'form' );
		if ( Validation( FormData ) ) {
			_this.attr( DisabledAttr, DisabledAttr );
			FormData.find( '.loader' ).show();
			$.ajax({
				url: ajax.url,
				type: 'post',
				dataType: 'json',
				data: {
					action: 'notify_subscribers_ajax_submit',
					ns_nonce: ajax.nonce,
					ns_email: FormData.find( '#ns-email' ).val(),
					ns_firstname: FormData.find( '#ns-firstname' ).val(),
					ns_lastname: FormData.find( '#ns-lastname' ).val(),
				},
				success: function( data ) {
					if ( data.result == 1 ) {
						FormData[0].reset();
						_this.removeAttr( DisabledAttr );
						FormData.find( '.loader' ).hide();
						window.location = ajax.subscriberPage;
					} else {
						_this.removeAttr( DisabledAttr );
						error_append = FormData.find( '#ns-email' );
						$( NsErrorElement( error_append ) ).text( data.message ).insertAfter( error_append );
						FormData.find( '.loader' ).hide();
					}
				},
				error: function( error, status, error ) {}
			});
		}
		return false;
	});
});
