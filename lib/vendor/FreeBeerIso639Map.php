<?php

// $CVSHeader: _freebeer/lib/ISO639/Map.php,v 1.2 2004/03/07 17:51:22 ross Exp $

// Copyright (c) 2002-2004, Ross Smith.  All rights reserved.
// Licensed under the BSD or LGPL License. See license.txt for details.

/*!
	\file ISO639/Map.php
	\brief ISO639 (language code) two letter code to three letter code map.
*/

/*!
	\class fbISO639_Map
	\brief ISO639 (language code) two letter code to three letter code map.
	
	\static
*/

class fbISO639_Map {
	/*!
		\see http://www.w3.org/WAI/ER/IG/ert/iso639.htm

		\return \c array
		\static
	*/

  // Peter Van Garderen: added 20 missing codes (30 July 2009)
  // removed xx inaccurate codes (10 Sept 2009)
  // see http://www.loc.gov/standards/iso639-2/php/code_list.php
	function &getID3ToID2Hash() {
		static $ID3_TO_ID2_HASH = array(
			'AAR'	=> 'AA',	// Afar
			'ABK'	=> 'AB',	// Abkhazian
			'AFR'	=> 'AF',	// Afrikaans
      'AKA' => 'AK',  // Akan
			'AMH'	=> 'AM',	// Amharic
			'ARA'	=> 'AR',	// Arabic
			'ARG'	=> 'AN',	// Aragonese
			'ASM'	=> 'AS',	// Assamese
			'AVA'	=> 'AV',	// Avaric
			'AVE'	=> 'AE',	// Avestan
			'AYM'	=> 'AY',	// Aymara
			'AZE'	=> 'AZ',	// Azerbaijani
			'BAK'	=> 'BA',	// Bashkir
			'BEL'	=> 'BE',	// Byelorussian
			'BEN'	=> 'BN',	// Bengali
			'BIH'	=> 'BH',	// Bihari
			'BIS'	=> 'BI',	// Bislama
   		'BRE'	=> 'BR',	// Breton	
      'BOS' => 'BS',  //Bosnian
			'BUL'	=> 'BG',	// Bulgarian
			'CAT'	=> 'CA',	// Catalan
			'COS'	=> 'CO',	// Corsican
			'CRE'	=> 'CR',	// Cree
			'DAN'	=> 'DA',	// Danish
			'DZO'	=> 'DZ',	// Dzongkha
			'ENG'	=> 'EN',	// English
			'EPO'	=> 'EO',	// Esperanto
			'EST'	=> 'ET',	// Estonian
			'FAO'	=> 'FO',	// Faroese
			'FIJ'	=> 'FJ',	// Fijian
			'FIN'	=> 'FI',	// Finnish
			'FRY'	=> 'FY',	// Frisian
			'GLG'	=> 'GL',	// Gallecian
			'GRN'	=> 'GN',	// Guarani
			'GUJ'	=> 'GU',	// Gujarati
			'HAU'	=> 'HA',	// Hausa
      'HAT' => 'HT',  // Haitian; Haitian Creole
			'HEB'	=> 'HE',	// Hebrew
			'HIN'	=> 'HI',	// Hindi
      'HRV' => 'HR', // Croatian
			'HUN'	=> 'HU',	// Hungarian
      'III' => 'II',  // Sichuan Yi; Nuosu
			'IKU'	=> 'IU',	// Inuktitut
      'ILE' => 'IE',  // Interlingue, Occidental
			'INA'	=> 'IA',	// Interlingua (International Auxiliary language Association)
			'IND'	=> 'ID',	// Indonesian
			'IPK'	=> 'IK',	// Inupiak
			'ITA'	=> 'IT',	// Italian
			'JPN'	=> 'JA',	// Japanese
			'KAL'	=> 'KL',	// Greenlandic
			'KAN'	=> 'KN',	// Kannada
			'KAS'	=> 'KS',	// Kashmiri
			'KAZ'	=> 'KK',	// Kazakh
			'KHM'	=> 'KM',	// Khmer
			'KIN'	=> 'RW',	// Kinyarwanda
			'KIR'	=> 'KY',	// Kirghiz
      'KOM' => 'KV',  // Komi
			'KOR'	=> 'KO',	// Korean
			'KUR'	=> 'KU',	// Kurdish
			'LAO'	=> 'LO',	// Lao
			'LAT'	=> 'LA',	// Latin
			'LAV'	=> 'LV',	// Latvian
			'LIN'	=> 'LN',	// Lingala
      'LIM' => 'LI',  // Limburger
			'LIT'	=> 'LT',	// Lithuanian
      'LTZ' => 'LB',  // Luxembourgish
      'LUG' => 'LG',  // Ganda
			'MAR'	=> 'MR',	// Marathi
			'MLG'	=> 'MG',	// Malagasy
			'MLT'	=> 'ML',	// Maltese
			'MOL'	=> 'MO',	// Moldavian
			'MON'	=> 'MN',	// Mongolian
			'NAU'	=> 'NA',	// Nauru
      'NAV' => 'NV',  // Navajo
			'NEP'	=> 'NE',	// Nepali
			'NNO'	=> 'NN',	// Norwegian Nynorsk
			'NOB'	=> 'NB',	// Norwegian Bokmål
			'NOR'	=> 'NO',	// Norwegian
			'OCI'	=> 'OC',	// Langue d\'Oc (post 1500)
      'OJI' => 'OJ',  // Ojibwa
			'ORI'	=> 'OR',	// Oriya
			'ORM'	=> 'OM',	// Oromo
			'PAN'	=> 'PA',	// Punjabi
			'POL'	=> 'PL',	// Polish
			'POR'	=> 'PT',	// Portuguese
			'PUS'	=> 'PS',	// Pushto
			'QUE'	=> 'QU',	// Quechua
			'ROH'	=> 'RM',	// Rhaeto-Romance
			'RUN'	=> 'RN',	// Rundi
			'RUS'	=> 'RU',	// Russian
			'SAG'	=> 'SG',	// Sango
			'SAN'	=> 'SA',	// Sanskrit
			'SCR'	=> 'SH',	// Serbo-Croatian
			'SIN'	=> 'SI',	// Singhalese
			'SLV'	=> 'SL',	// Slovenian
			'SMO'	=> 'SM',	// Samoan
      'SME' => 'SE',  // Northern Sami
			'SNA'	=> 'SN',	// Shona
			'SND'	=> 'SD',	// Sindhi
			'SOM'	=> 'SO',	// Somali
			'SOT'	=> 'ST',	// Sotho, Southern
			'SSW'	=> 'SS',	// Siswant
      'SRD' => 'SC',  // Sardinian
      'SRP' => 'SR',  // Serbian
			'SUN'	=> 'SU',	// Sudanese
			'SWA'	=> 'SW',	// Swahili
      'TAH' => 'TY',  // Tahitian
			'TAM'	=> 'TA',	// Tamil
			'TAT'	=> 'TT',	// Tatar
			'TEL'	=> 'TE',	// Telugu
			'TGK'	=> 'TG',	// Tajik
			'TGL'	=> 'TL',	// Tagalog
			'THA'	=> 'TH',	// Thai
			'TIR'	=> 'TI',	// Tigrinya
			'TOG'	=> 'TO',	// Tonga (Nyasa)
			'TSN'	=> 'TN',	// Tswana
			'TSO'	=> 'TS',	// Tsonga
			'TUK'	=> 'TK',	// Turkmen
			'TUR'	=> 'TR',	// Turkish
			'TWI'	=> 'TW',	// Twi
			'UIG'	=> 'UG',	// Uighur
			'UKR'	=> 'UK',	// Ukrainian
			'URD'	=> 'UR',	// Urdu
			'UZB'	=> 'UZ',	// Uzbek
			'VIE'	=> 'VI',	// Vietnamese
			'VOL'	=> 'VO',	// Volapuk
			'WOL'	=> 'WO',	// Wolof
			'XHO'	=> 'XH',	// Xhosa
			'YID'	=> 'YI',	// Yiddish
			'YOR'	=> 'YO',	// Yoruba
			'ZHA'	=> 'ZA',	// Zhuang
			'ZUL'	=> 'ZU',	// Zulu
			'BAQ'	=> 'EU',	// Basque (also eus)
			'FRA'	=> 'FR',	// French (also fre)
			'GLA'	=> 'GD',	// Gaelic (Scots) 
			'DEU'	=> 'DE',	// German (also ger)
			'ELL'	=> 'EL',	// Greek, Modern (1453-) (also gre)
			'ARM'	=> 'HY',	// Armenian (also hye)
			'GLE'	=> 'GA',	// Irish (also iri)
			'ICE'	=> 'IS',	// Icelandic (also isl)
			'GEO'	=> 'KA',	// Georgian (also kat)
			'MAC'	=> 'MK',	// Macedonian (also mak)
			'MAO'	=> 'MI',	// Maori (also mri)
			'MAY'	=> 'MS',	// Malay (also msa)
			'BUR'	=> 'MY',	// Burmese (also mya)
			'DUT'	=> 'NL',	// Dutch (also nla)
			'FAS'	=> 'FA',	// Persian (also per)
			'RON'	=> 'RO',	// Romanian (also rum)
			'SLK'	=> 'SK',	// Slovak (also slo)
			'ALB'	=> 'SQ',	// Albanian (also sqi)
			'SVE'	=> 'SV',	// Swedish (also swe)
			'BOD'	=> 'BO',	// Tibetan (also tib)
			'CYM'	=> 'CY',	// Welsh (also wel)
			'CHI'	=> 'ZH',	// Chinese (also zho)
			'JAV'	=> 'JV',	// Javanese (also jaw/jw)
      'CES' => 'CS',  // Czech (also cze)
			'CZE'	=> 'CS',	// Czech (also ces)
			'EUS'	=> 'EU',	// Basque (also baq)
			'FRE'	=> 'FR',	// French (also fra)
			'GER'	=> 'DE',	// German (also deu)
			'GRE'	=> 'EL',	// Greek, Modern (1453-) (also ell)
			'HYE'	=> 'HY',	// Armenian (also arm)
			'ISL'	=> 'IS',	// Icelandic (also ice)
			'KAT'	=> 'KA',	// Georgian (also geo)
			'MAK'	=> 'MK',	// Macedonian (also mac)
			'MRI'	=> 'MI',	// Maori (also mao)
			'MSA'	=> 'MS',	// Malay (also may)
			'MYA'	=> 'MY',	// Burmese (also bur)
			'NLD'	=> 'NL',	// Dutch (also dut)
			'PER'	=> 'FA',	// Persian (also fas)
			'RUM'	=> 'RO',	// Romanian (also ron)
			'SLO'	=> 'SK',	// Slovak (also slk)
			'SPA'	=> 'ES',	// Spanish (also esl)
			'SQI'	=> 'SQ',	// Albanian (also alb)
			'SWE'	=> 'SV',	// Swedish (also sve)
			'TIB'	=> 'BO',	// Tibetan (also bod)
			'WEL'	=> 'CY',	// Welsh (also cym)
			'ZHO'	=> 'ZH',	// Chinese (also chi)
		);

		// make sure no dups snuck in
		// assert('count($ID3_TO_ID2_HASH) == (179 + 2)');

		return $ID3_TO_ID2_HASH;
	}

	/*!
		\return \c array
		\static
	*/
	function &getID2ToID3Hash() {
		static $ID2_TO_ID3_HASH = null;

		if (is_null($ID2_TO_ID3_HASH)) {
			$ID3_TO_ID2_HASH = &fbISO639_Map::getID3ToID2Hash();
			$ID2_TO_ID3_HASH = array_flip($ID3_TO_ID2_HASH);

      // Peter Van Garderen:converted all codes to use 639-2b instead of 639-2t (10 Sept 2009)
      // removed duplicates and inaccurate codes
      // see http://www.loc.gov/standards/iso639-2/php/code_list.php
			$ID2_TO_ID3_HASH['SQ']	= 'ALB'; // Albanian (also sqi)
			$ID2_TO_ID3_HASH['HY']	= 'ARM'; // Armenian (also hye)
			$ID2_TO_ID3_HASH['EU']	= 'BAQ'; // Basque (also eus)
			$ID2_TO_ID3_HASH['BO']	= 'TIB'; // Tibetan (also bod)
			$ID2_TO_ID3_HASH['MY']	= 'BUR'; // Burmese (also mya)
			$ID2_TO_ID3_HASH['CS']	= 'CZE'; // Czech (also ces)
			$ID2_TO_ID3_HASH['ZH']	= 'CHI'; // Chinese (also zho)
			$ID2_TO_ID3_HASH['CY']	= 'WEL'; // Welsh (also cym)
			$ID2_TO_ID3_HASH['DE']	= 'GER'; // German (also deu)
			$ID2_TO_ID3_HASH['NL']	= 'DUT'; // Dutch (also nld)
			$ID2_TO_ID3_HASH['EL']	= 'GRE'; // Greek, Modern (1453-) (also ell)
			$ID2_TO_ID3_HASH['FA']	= 'PER'; // Persian (also fas)
			$ID2_TO_ID3_HASH['FR']	= 'FRE'; // French (also fra)
			$ID2_TO_ID3_HASH['KA']	= 'GEO'; // Georgian (also kat)
			$ID2_TO_ID3_HASH['IS']	= 'ICE'; // Icelandic (also isl)
			$ID2_TO_ID3_HASH['MK']	= 'MAC'; // Macedonian (also mak)
			$ID2_TO_ID3_HASH['MI']	= 'MAO'; // Maori (also mri)
			$ID2_TO_ID3_HASH['MS']	= 'MAY'; // Malay (also msa)
			$ID2_TO_ID3_HASH['RO']	= 'RUM'; // Romanian (also ron)
			$ID2_TO_ID3_HASH['SK']	= 'SLO'; // Slovak (also slk)
			$ID2_TO_ID3_HASH['SV']	= 'SVE'; // Swedish (also swe)
		}

		return $ID2_TO_ID3_HASH;
	}

	/*!
		\static
	*/
	function getID2($id3) {
		$ID3_TO_ID2_HASH = &fbISO639_Map::getID3ToID2Hash();
		$id3 = strtoupper($id3);
		return isset($ID3_TO_ID2_HASH[$id3]) ? $ID3_TO_ID2_HASH[$id3] : false;
	}

	/*!
		\static
	*/
	function getID3($id2) {
		$ID2_TO_ID3_HASH = &fbISO639_Map::getID2ToID3Hash();
		$id2 = strtoupper($id2);
		return isset($ID2_TO_ID3_HASH[$id2]) ? $ID2_TO_ID3_HASH[$id2] : false;
	}

}

?>
