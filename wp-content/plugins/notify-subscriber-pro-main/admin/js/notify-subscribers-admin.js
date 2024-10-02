if ( typeof jQuery != 'undefined') {
	( function( $ ) {
		// Global var
		var ActiveTab = 'active';
		var href = 'href';
		var div = 'div';
		var Wrapper = $( 'body #wrapper' );
		var Success = 'notice-success';

		// var for main tabs
		var NotifySubscriberTab = $( '#notify-subscribertab a' );
		var TabContentDiv = $( '#notify-subscribers-block' );

		// var for sub tabs
		var NotifySubTab = $( '#notify-subtab a' );
		var SubTabContentDiv = $( '#notify_mailtemplate_block' );
		var fieldset = 'form fieldset';

		// Pagination
		var show_per_page = 10;
		var number_of_items = $( 'div#notify_subscribers_users tbody tr ' ).size();
		var ActivePage = '.active_page';
		var UserTable = $( 'div#notify_subscribers_users');
		var CurrentPage = $( '#current_page' );
		var Next = $( 'a.next_link' );
		var Previous = $( 'a.previous_link' );

		// Main tabs
		NotifySubscriberTab.each( function() {
			var _this = $(this);
			if ( _this.hasClass( ActiveTab ) ) {
				TabContentDiv.find( '>' + div ).hide();
				TabContentDiv.find( _this.attr( href ) ).show();
			}
			_this.on( 'click', function( event ) {
				event.preventDefault();
				TabContentDiv.find( '>' + div ).hide();
				NotifySubscriberTab.removeAttr( 'class' );
				TabContentDiv.find( _this.attr( href ) ).show();
				_this.addClass( ActiveTab );
				TabContentDiv.removeClass().addClass( _this.attr( href ).replace( '#', '' ) ).addClass('ns-admin-tab-content');
			});
		});
		// Sub tabs
		NotifySubTab.each( function() {
			var $this = $(this);
			if ( $this.hasClass( ActiveTab ) ) {
				SubTabContentDiv.find( '>' + fieldset ).hide();
				SubTabContentDiv.find( fieldset + '.' + $this.attr( href ).replace( '#', '' ) ).show();
			}
			$this.on( 'click', function( event ) {
				event.preventDefault();
				SubTabContentDiv.find( '>' + fieldset ).hide();
				NotifySubTab.removeAttr( 'class' );
				SubTabContentDiv.find( fieldset + '.' + $this.attr( href ).replace( '#', '' ) ).show();
				$this.addClass( ActiveTab );
			} );
		});
		// Error message hide.
		if ( Wrapper.find( div ).hasClass( Success ) ) {
			setTimeout( function() {
				Wrapper.find( div + '.' + Success ).fadeOut( 'slow' );
			} ,5000 );
		}
		// DataTable.
		$( '#user-list' ).DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		} );

		// Collapse.
		if( $( 'body' ).find( '#notify_subscribers_settings' ) ) {
			$( '.ns-admin-fieldset-group' ).attr( 'id', 'accordion' );
		} else {
			$( '.ns-admin-fieldset-group' ).removeAttr( 'id', 'accordion' );
		}
		// Accordion.
		$( '#accordion' ).on('show.bs.collapse', function() {
			$( '#accordion .in' ).collapse( 'hide' );
		});

		// MailChimp enabled/disabled.
		$( '#mailchimp-on-off' ).on( 'click', function() {
			var $this	= $( this );
			if ( ! $this.is( ':checked' ) ) {
				$this.parents( '.row' ).find( 'input[type="text"]' ).prop( { readonly: true } );
			} else {
				$this.parents( '.row' ).find( 'input[type="text"]' ).prop( { readonly: false } );
			}
		} );
	})( jQuery );
}