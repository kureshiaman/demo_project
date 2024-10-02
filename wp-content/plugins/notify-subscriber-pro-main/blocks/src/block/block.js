
import icon from './icon';

( function( wp ) {

	const Form = NS_FORM.html.form;
	const Email = NS_FORM.html.form.email;
	const FirstName = NS_FORM.html.form.firstname;
	const LastName = NS_FORM.html.form.lastname;
	const Submit = NS_FORM.html.form.submit;

	/**
	 * Registers a new block provided a unique name and an object defining its behavior.
	 * @see https://github.com/WordPress/gutenberg/tree/master/blocks#api
	 */
	const { registerBlockType } = wp.blocks;
	/**
	 * Returns a new element of given type. Element is an abstraction layer atop React.
	 * @see https://github.com/WordPress/gutenberg/tree/master/element#element
	 */
	const el = wp.element.createElement;
	/**
	 * Retrieves the translation of text.
	 * @see https://github.com/WordPress/gutenberg/tree/master/i18n#api
	 */
	const __ = wp.i18n.__;

	/**
	 * block controles
	 */
	const { InspectorControls } = wp.editor;

	/**
	 * Creates a lable.
	 *
	 * @class      CreateLable (name)
	 * @param      {<type>}  data    The data
	 * @return     {<type>}  { description_of_the_return_value }
	 */
	 let CreateLable = ( data ) =>  {
	 	let LabelHtml = [];
	 	LabelHtml.push(
	 		el(
	 			'label', {
	 				className: 'form-label',
	 				for: 'ns-' + data.id,
	 			},
	 			data.label
	 		)
	 		);
	 	return LabelHtml;
	 };

	/**
	 * Last name
	 *
	 * @class      NS_LastName (name)
	 * @return     {Array}  { description_of_the_return_value }
	 */
	let NS_LastName = () => {
		let LastName_Field = LastName || {}; 

		if ( Object.keys( LastName_Field ).length == 0 ) return;

		let lastname_html = [];
		lastname_html.push(
			el(
				'div', {
					className: 'ns-group form-group',
				},
				CreateLable( LastName_Field ),
				el(
					'input', {
						type: 'text',
						name: 'ns-' + LastName_Field.name,
						class: 'ns-input ns-lastname' + ' ' + LastName_Field.class || '',
						id: 'ns-' + LastName_Field.id,
						placeholder: LastName_Field.placeholder
					}
					)
				)
			);
		return lastname_html;
	};

	/**
	 * Firstname
	 *
	 * @class      NS_Firstname (name)
	 * @return     {Array}  { description_of_the_return_value }
	 */
	let NS_Firstname = () => {
		let Firstname_Field = FirstName || {}; 

		if ( Object.keys( Firstname_Field ).length == 0 ) return;

		let Firstname_html = [];
		Firstname_html.push(
			el(
				'div', {
					className: 'ns-group form-group',
				},
				CreateLable( Firstname_Field ),
				el(
					'input', {
						type: 'text',
						name: 'ns-' + Firstname_Field.name,
						class: 'ns-input ns-firstname' + ' ' + Firstname_Field.class || '',
						id: 'ns-' + Firstname_Field.id,
						placeholder: Firstname_Field.placeholder
					}
					)
				)
			);
		return Firstname_html;
	};

	function notify_subscriber_form() {
		return el(
			'div', {
				className: 'ns-container'
			},
			el(
				'div', {
					className: 'ns-wrapper',
				},
				el(
					'form', {
						className: 'ns-form' + ' ' + Form.class,
						id: 'ns-form',
						method: 'post',
						name: 'ns-form',
					},
					NS_Firstname(),
					NS_LastName(),
					el(
						'div', {
							className: 'ns-group form-group',
						},
						CreateLable( Email ),
						el(
							'input', {
								type: 'text',
								name: 'ns-' + Email.name,
								class: 'ns-input ns-email' + ' ' + Email.class || '',
								id: 'ns-' + Email.id,
								placeholder: Email.placeholder
							}
							)
						),
					el(
						'div', {
							className: 'ns-action',
						},
						el(
							'input', {
								type: 'submit',
								name: 'ns-' + Submit.name,
								className: 'ns-submit' + ' ' + Submit.class,
								value: Submit.value,
								onClick:( event ) => {
									event.preventDefault();
								}
							}
						)
					),
				)
			)
		);
	}

	/**
	 * Every block starts by registering a new block type definition.
	 * @see https://wordpress.org/gutenberg/handbook/block-api/
	 */
	registerBlockType( 'notify-subscribers/notify-subscribers', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __( 'NS FORM' ),

		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'widgets',
		icon,
		/**
		 * Optional block extended support features.
		 */
		supports: {
			// Removes support for an HTML mode.
			html: false,
		},

		/**
		 * The edit function describes the structure of your block in the context of the editor.
		 * This represents what the editor will render when the block is used.
		 * @see https://wordpress.org/gutenberg/handbook/block-edit-save/#edit
		 *
		 * @param {Object} [props] Properties passed from the editor.
		 * @return {Element}       Element to render.
		 */
		 edit: props =>  {

		 	let NSFORM = notify_subscriber_form();
		 	
		 	const controls = [
			 	el(
			 		InspectorControls,
			 		{},
			 		el(
			 			'hr',
			 			),
			 		el(
			 			'a', {
			 				href: NS_FORM.settings,
			 				target: '_blank'
			 			},
			 			el(
			 				'strong', {}, __( 'Advanced Settings' )
			 				),
			 			)
			 		,
			 		),
			 ];
		 	return [ controls, NSFORM ];
		 },

		/**
		 * The save function defines the way in which the different attributes should be combined
		 * into the final markup, which is then serialized by Gutenberg into `post_content`.
		 * @see https://wordpress.org/gutenberg/handbook/block-edit-save/#save
		 *
		 * @return {Element}       Element to render.
		 */
		save: props => {
			return null;
		}
	} );
} )(
	window.wp
);
