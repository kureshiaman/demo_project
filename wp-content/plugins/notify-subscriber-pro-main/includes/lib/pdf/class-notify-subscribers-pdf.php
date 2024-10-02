<?php
// require fpdf file.
require_once 'fpdf.php';
define( 'FPDF_FONTPATH','font/' );

/**
 * PDF class FPDF
 */
if ( ! class_exists( 'Notify_Subscribers_PDF' ) ) {
	/**
	 * PDF class
	 */
	class Notify_Subscribers_PDF extends FPDF {

		/**
		 * Page header
		 */
		function Header() {
			// Logo
			$this->Image( NOTIFY_SUBSCRIBERS_IN_PLUGIN_DIR . 'admin/images/logo.png', 10, 6, 20 );
			// Arial bold 15
			$this->SetFont( 'Arial', 'B', 15 );
			// Move to the right
			$this->Cell( 60 );
			// Title
			$this->Cell( 80, 10, 'Notify Subscribers Users', 1, 0 , 'C' );
			// Line
			$this->Line( 10, 35, 200, 35 );
			// Line break
			$this->Ln( 40 );
		}
		
		/**
		 * Page footer
		 */
		function Footer() {
			// Position at 1.5 cm from bottom
			$this->SetY( -15 );
			// Arial italic 8
			$this->SetFont( 'Arial', 'I', 8 );
			// Page number
			$this->Cell( 0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C' );
		}

		/**
		 * Html table
		 *
		 * @param      array  $header  The header
		 * @param      array  $data    The data
		 */
		function BasicTable( $header, $data ) {
			// Header
			foreach( $header as $table_col )
				if ( $table_col == '#' ) {
					$this->Cell( 10, 7, $table_col, 1, 0 , 'C' );
				} elseif( $table_col == "Email" ) {
					$this->Cell( 60, 7, $table_col, 1, 0 , 'C' );
				} elseif( $table_col == "Username" ) {
					$this->Cell( 40, 7, $table_col, 1, 0 , 'C' );
				} else {
					$this->Cell( 27, 7, $table_col, 1, 0 , 'C' );
				}
				$this->Ln();
			// Data
			foreach( $data as $row ) {
				foreach( $row as $key => $table_col )
					if ( $key == 0 ) {
						$this->Cell( 10, 6, $table_col, 1, 0 , 'C' );
					} elseif( $key == 4 ) {
						$this->Cell( 60, 6, $table_col, 1, 0 , 'C' );
					} elseif( $key == 3 ) {
						$this->Cell( 40, 6, $table_col, 1, 0 , 'C' );
					} else {
						$this->Cell( 27, 6, $table_col, 1, 0 , 'C' );
					}
					$this->Ln();
			}
		}
	}
}
