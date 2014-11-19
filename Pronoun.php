<?php

class Pronouning {
	
	/* 
	 * $data is the input data containing possible possessive pronoun
	 * Returns $data with new field added to Who and What models:
	 *    -Who: 'sex' if applicable, string (sex is always applicable Dave)
	 *    -What: 'possessive', integer
	 */
	
	public function pronounItUp( $data ){
		
		$pronouns = array( 'my ', 'his ', 'her ', 'its ', 'our ', 'their ' );
		
		foreach( $pronouns as $pronoun ){

			if( stripos( $data['What']['what_text'], $pronoun ) !== false ){

				$possessive = true;

				switch( $pronoun ) {
					case 'his ':
						$data['Who']['sex'] = 'male';
						$data['What']['possessive'] = 2;
						break;
					case 'her ':
						$data['Who']['sex'] = 'female';
						$data['What']['possessive'] = 2;											
						break;
					case 'my ':
						$data['What']['possessive'] = 1;											
						break;
					case 'its ':
						$data['Who']['sex'] = 'sexless';
						$data['What']['possessive'] = 2;											
						break;							
					case 'our ':
						$data['What']['possessive'] = 3;											
						break;
					case 'their ':
						$data['What']['possessive'] = 4;											
						break;	
				}
				
				// Removes the pronoun from the entry.
				$data['What']['what_text'] = substr_replace( $data['What']['what_text'], '', 0, strlen( $pronoun ) );
				break;
				
			} else {
				$data['What']['possessive'] = 0;
			}
		}

		return $data;
	}

	/*
	 *	$who is the array of data pulled from the database starting at the "Who" model.
	 *  $what is the array of data pulled from the database starting at the "What" model.
	 *  Returns string containing the appropriate pronoun.
	 */
	public function getPronoun($who){
		
		if ( @$who->sex == 'male' ){
			$pronoun = 'his';
		} elseif ( @$who->sex == 'female'){
			$pronoun = 'her';
		} elseif ( @$who->sex == 'sexless'){
			$pronoun = 'its';
		} else {
			$pronoun = 'their';
		}
			
		return $pronoun;
	}
}