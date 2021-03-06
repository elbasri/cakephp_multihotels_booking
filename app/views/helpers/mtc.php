<?php
class MtcHelper extends AppHelper{
	var $helpers = array('Html','Lng','Session');
	
	
	
		 
		 
		 
function utf8entities($source)
	{
			//    array used to figure what number to decrement from character order value 
			//    according to number of characters used to map unicode to ascii by utf-8
			   $decrement[4] = 240;
			   $decrement[3] = 224;
			   $decrement[2] = 192;
			   $decrement[1] = 0;
			   
			//    the number of bits to shift each charNum by
			   $shift[1][0] = 0;
			   $shift[2][0] = 6;
			   $shift[2][1] = 0;
			   $shift[3][0] = 12;
			   $shift[3][1] = 6;
			   $shift[3][2] = 0;
			   $shift[4][0] = 18;
			   $shift[4][1] = 12;
			   $shift[4][2] = 6;
			   $shift[4][3] = 0;
			   
			   $pos = 0;
			   $len = strlen($source);
			   $encodedString = '';
			   while ($pos < $len)
			   {
				  $charPos = substr($source, $pos, 1);
				  $asciiPos = ord($charPos);
				  if ($asciiPos < 128)
				  {
					 $encodedString .= htmlentities($charPos);
					 $pos++;
					 continue;
				  }
				  
				  $i=1;
				  if (($asciiPos >= 240) && ($asciiPos <= 255))  // 4 chars representing one unicode character
					 $i=4;
				  else if (($asciiPos >= 224) && ($asciiPos <= 239))  // 3 chars representing one unicode character
					 $i=3;
				  else if (($asciiPos >= 192) && ($asciiPos <= 223))  // 2 chars representing one unicode character
					 $i=2;
				  else  // 1 char (lower ascii)
					 $i=1;
				  $thisLetter = substr($source, $pos, $i);
				  $pos += $i;
				  
			//       process the string representing the letter to a unicode entity
				  $thisLen = strlen($thisLetter);
				  $thisPos = 0;
				  $decimalCode = 0;
				  while ($thisPos < $thisLen)
				  {
					 $thisCharOrd = ord(substr($thisLetter, $thisPos, 1));
					 if ($thisPos == 0)
					 {
						$charNum = intval($thisCharOrd - $decrement[$thisLen]);
						$decimalCode += ($charNum << $shift[$thisLen][$thisPos]);
					 }
					 else
					 {
						$charNum = intval($thisCharOrd - 128);
						$decimalCode += ($charNum << $shift[$thisLen][$thisPos]);
					 }
					 
					 $thisPos++;
				  }
				  
				  $encodedLetter = '&#'. str_pad($decimalCode, ($thisLen==1)?3:5, '0', STR_PAD_LEFT).';';
				  $encodedString .= $encodedLetter;
			   }
			   
			   return $encodedString;
	}

	
	
	var $pays = array(
		 'MA' => array('FR' => 'Maroc', 'EN' => 'Morocco'),
		 'AF' => array('FR' => 'Afghanistan', 'EN' => 'Afghanistan'),
		 'ZA' => array('FR' => 'Afrique du Sud', 'EN' => 'South Africa'),
		 'AL' => array('FR' => 'Albanie', 'EN' => 'Albania'),
		 'DZ' => array('FR' => 'Algérie', 'EN' => 'Algeria'),
		 'DE' => array('FR' => 'Allemagne', 'EN' => 'Germany'),
		 'AD' => array('FR' => 'Andorre', 'EN' => 'Andorra'),
		 'AO' => array('FR' => 'Angola', 'EN' => 'Angola'),
		 'AI' => array('FR' => 'Anguilla', 'EN' => 'Anguilla'),
		 'AQ' => array('FR' => 'Antarctique', 'EN' => 'Antarctica'),
		 'AG' => array('FR' => 'Antigua-et-Barbuda', 'EN' => 'Antigua & Barbuda'),
		 'AN' => array('FR' => 'Antilles néerlandaises', 'EN' => 'Netherlands Antilles'),
		 'SA' => array('FR' => 'Arabie saoudite', 'EN' => 'Saudi Arabia'),
		 'AR' => array('FR' => 'Argentine', 'EN' => 'Argentina'),
		 'AM' => array('FR' => 'Arménie', 'EN' => 'Armenia'),
		 'AW' => array('FR' => 'Aruba', 'EN' => 'Aruba'),
		 'AU' => array('FR' => 'Australie', 'EN' => 'Australia'),
		 'AT' => array('FR' => 'Autriche', 'EN' => 'Austria'),
		 'AZ' => array('FR' => 'Azerbaïdjan', 'EN' => 'Azerbaijan'),
		 'BJ' => array('FR' => 'Bénin', 'EN' => 'Benin'),
		 'BS' => array('FR' => 'Bahamas', 'EN' => 'Bahamas, The'),
		 'BH' => array('FR' => 'Bahreïn', 'EN' => 'Bahrain'),
		 'BD' => array('FR' => 'Bangladesh', 'EN' => 'Bangladesh'),
		 'BB' => array('FR' => 'Barbade', 'EN' => 'Barbados'),
		 'PW' => array('FR' => 'Belau', 'EN' => 'Palau'),
		 'BE' => array('FR' => 'Belgique', 'EN' => 'Belgium'),
		 'BZ' => array('FR' => 'Belize', 'EN' => 'Belize'),
		 'BM' => array('FR' => 'Bermudes', 'EN' => 'Bermuda'),
		 'BT' => array('FR' => 'Bhoutan', 'EN' => 'Bhutan'),
		 'BY' => array('FR' => 'Biélorussie', 'EN' => 'Belarus'),
		 'MM' => array('FR' => 'Birmanie', 'EN' => 'Myanmar (ex-Burma)'),
		 'BO' => array('FR' => 'Bolivie', 'EN' => 'Bolivia'),
		 'BA' => array('FR' => 'Bosnie-Herzégovine', 'EN' => 'Bosnia and Herzegovina'),
		 'BW' => array('FR' => 'Botswana', 'EN' => 'Botswana'),
		 'BR' => array('FR' => 'Brésil', 'EN' => 'Brazil'),
		 'BN' => array('FR' => 'Brunei', 'EN' => 'Brunei Darussalam'),
		 'BG' => array('FR' => 'Bulgarie', 'EN' => 'Bulgaria'),
		 'BF' => array('FR' => 'Burkina Faso', 'EN' => 'Burkina Faso'),
		 'BI' => array('FR' => 'Burundi', 'EN' => 'Burundi'),
		 'CI' => array('FR' => 'Côte d\'Ivoire', 'EN' => 'Ivory Coast (see Cote d\'Ivoire)'),
		 'KH' => array('FR' => 'Cambodge', 'EN' => 'Cambodia'),
		 'CM' => array('FR' => 'Cameroun', 'EN' => 'Cameroon'),
		 'CA' => array('FR' => 'Canada', 'EN' => 'Canada'),
		 'CV' => array('FR' => 'Cap-Vert', 'EN' => 'Cape Verde'),
		 'CL' => array('FR' => 'Chili', 'EN' => 'Chile'),
		 'CN' => array('FR' => 'Chine', 'EN' => 'China'),
		 'CY' => array('FR' => 'Chypre', 'EN' => 'Cyprus'),
		 'CO' => array('FR' => 'Colombie', 'EN' => 'Colombia'),
		 'KM' => array('FR' => 'Comores', 'EN' => 'Comoros'),
		 'CG' => array('FR' => 'Congo', 'EN' => 'Congo'),
		 'KP' => array('FR' => 'Corée du Nord', 'EN' => 'Korea, Demo. People\'s Rep. of'),
		 'KR' => array('FR' => 'Corée du Sud', 'EN' => 'Korea, (South) Republic of'),
		 'CR' => array('FR' => 'Costa Rica', 'EN' => 'Costa Rica'),
		 'HR' => array('FR' => 'Croatie', 'EN' => 'Croatia'),
		 'CU' => array('FR' => 'Cuba', 'EN' => 'Cuba'),
		 'DK' => array('FR' => 'Danemark', 'EN' => 'Denmark'),
		 'DJ' => array('FR' => 'Djibouti', 'EN' => 'Djibouti'),
		 'DM' => array('FR' => 'Dominique', 'EN' => 'Dominica'),
		 'EG' => array('FR' => 'Égypte', 'EN' => 'Egypt'),
		 'AE' => array('FR' => 'Émirats arabes unis', 'EN' => 'United Arab Emirates'),
		 'EC' => array('FR' => 'Équateur', 'EN' => 'Ecuador'),
		 'ER' => array('FR' => 'Érythrée', 'EN' => 'Eritrea'),
		 'ES' => array('FR' => 'Espagne', 'EN' => 'Spain'),
		 'EE' => array('FR' => 'Estonie', 'EN' => 'Estonia'),
		 'US' => array('FR' => 'États-Unis', 'EN' => 'United States'),
		 'ET' => array('FR' => 'Éthiopie', 'EN' => 'Ethiopia'),
		 'FI' => array('FR' => 'Finlande', 'EN' => 'Finland'),
		 'FR' => array('FR' => 'France', 'EN' => 'France'),
		 'GE' => array('FR' => 'Géorgie', 'EN' => 'Georgia'),
		 'GA' => array('FR' => 'Gabon', 'EN' => 'Gabon'),
		 'GM' => array('FR' => 'Gambie', 'EN' => 'Gambia, the'),
		 'GH' => array('FR' => 'Ghana', 'EN' => 'Ghana'),
		 'GI' => array('FR' => 'Gibraltar', 'EN' => 'Gibraltar'),
		 'GR' => array('FR' => 'Grèce', 'EN' => 'Greece'),
		 'GD' => array('FR' => 'Grenade', 'EN' => 'Grenada'),
		 'GL' => array('FR' => 'Groenland', 'EN' => 'Greenland'),
		 'GP' => array('FR' => 'Guadeloupe', 'EN' => 'Guinea, Equatorial'),
		 'GU' => array('FR' => 'Guam', 'EN' => 'Guam'),
		 'GT' => array('FR' => 'Guatemala', 'EN' => 'Guatemala'),
		 'GN' => array('FR' => 'Guinée', 'EN' => 'Guinea'),
		 'GQ' => array('FR' => 'Guinée équatoriale', 'EN' => 'Equatorial Guinea'),
		 'GW' => array('FR' => 'Guinée-Bissao', 'EN' => 'Guinea-Bissau'),
		 'GY' => array('FR' => 'Guyana', 'EN' => 'Guyana'),
		 'GF' => array('FR' => 'Guyane française', 'EN' => 'Guiana, French'),
		 'HT' => array('FR' => 'Haïti', 'EN' => 'Haiti'),
		 'HN' => array('FR' => 'Honduras', 'EN' => 'Honduras'),
		 'HK' => array('FR' => 'Hong Kong', 'EN' => 'Hong Kong, (China)'),
		 'HU' => array('FR' => 'Hongrie', 'EN' => 'Hungary'),
		 'BV' => array('FR' => 'Ile Bouvet', 'EN' => 'Bouvet Island'),
		 'CX' => array('FR' => 'Ile Christmas', 'EN' => 'Christmas Island'),
		 'NF' => array('FR' => 'Ile Norfolk', 'EN' => 'Norfolk Island'),
		 'KY' => array('FR' => 'Iles Cayman', 'EN' => 'Cayman Islands'),
		 'CK' => array('FR' => 'Iles Cook', 'EN' => 'Cook Islands'),
		 'FO' => array('FR' => 'Iles Féroé', 'EN' => 'Faroe Islands'),
		 'FK' => array('FR' => 'Iles Falkland', 'EN' => 'Falkland Islands (Malvinas)'),
		 'FJ' => array('FR' => 'Iles Fidji', 'EN' => 'Fiji'),
		 'GS' => array('FR' => 'Iles Géorgie du Sud et Sandwich du Sud', 'EN' => 'S. Georgia and S. Sandwich Is.'),
		 'HM' => array('FR' => 'Iles Heard et McDonald', 'EN' => 'Heard and McDonald Islands'),
		 'MH' => array('FR' => 'Iles Marshall', 'EN' => 'Marshall Islands'),
		 'PN' => array('FR' => 'Iles Pitcairn', 'EN' => 'Pitcairn Island'),
		 'SB' => array('FR' => 'Iles Salomon', 'EN' => 'Solomon Islands'),
		 'SJ' => array('FR' => 'Iles Svalbard et Jan Mayen', 'EN' => 'Svalbard and Jan Mayen Islands'),
		 'TC' => array('FR' => 'Iles Turks-et-Caicos', 'EN' => 'Turks and Caicos Islands'),
		 'VI' => array('FR' => 'Iles Vierges américaines', 'EN' => 'Virgin Islands, U.S.'),
		 'VG' => array('FR' => 'Iles Vierges britanniques', 'EN' => 'Virgin Islands, British'),
		 'CC' => array('FR' => 'Iles des Cocos (Keeling)', 'EN' => 'Cocos (Keeling) Islands'),
		 'UM' => array('FR' => 'Iles mineures éloignées des États-Unis', 'EN' => 'US Minor Outlying Islands'),
		 'IN' => array('FR' => 'Inde', 'EN' => 'India'),
		 'ID' => array('FR' => 'Indonésie', 'EN' => 'Indonesia'),
		 'IR' => array('FR' => 'Iran', 'EN' => 'Iran, Islamic Republic of'),
		 'IQ' => array('FR' => 'Iraq', 'EN' => 'Iraq'),
		 'IE' => array('FR' => 'Irlande', 'EN' => 'Ireland'),
		 'IS' => array('FR' => 'Islande', 'EN' => 'Iceland'),
		 'IL' => array('FR' => 'Israël', 'EN' => 'Israel'),
		 'IT' => array('FR' => 'Italie', 'EN' => 'Italy'),
		 'JM' => array('FR' => 'Jamaïque', 'EN' => 'Jamaica'),
		 'JP' => array('FR' => 'Japon', 'EN' => 'Japan'),
		 'JO' => array('FR' => 'Jordanie', 'EN' => 'Jordan'),
		 'KZ' => array('FR' => 'Kazakhstan', 'EN' => 'Kazakhstan'),
		 'KE' => array('FR' => 'Kenya', 'EN' => 'Kenya'),
		 'KG' => array('FR' => 'Kirghizistan', 'EN' => 'Kyrgyzstan'),
		 'KI' => array('FR' => 'Kiribati', 'EN' => 'Kiribati'),
		 'KW' => array('FR' => 'Koweït', 'EN' => 'Kuwait'),
		 'LA' => array('FR' => 'Laos', 'EN' => 'Lao People\'s Democratic Republic'),
		 'LS' => array('FR' => 'Lesotho', 'EN' => 'Lesotho'),
		 'LV' => array('FR' => 'Lettonie', 'EN' => 'Latvia'),
		 'LB' => array('FR' => 'Liban', 'EN' => 'Lebanon'),
		 'LR' => array('FR' => 'Liberia', 'EN' => 'Liberia'),
		 'LY' => array('FR' => 'Libye', 'EN' => 'Libyan Arab Jamahiriya'),
		 'LI' => array('FR' => 'Liechtenstein', 'EN' => 'Liechtenstein'),
		 'LT' => array('FR' => 'Lituanie', 'EN' => 'Lithuania'),
		 'LU' => array('FR' => 'Luxembourg', 'EN' => 'Luxembourg'),
		 'MO' => array('FR' => 'Macao', 'EN' => 'Macao, (China)'),
		 'MG' => array('FR' => 'Madagascar', 'EN' => 'Madagascar'),
		 'MY' => array('FR' => 'Malaisie', 'EN' => 'Malaysia'),
		 'MW' => array('FR' => 'Malawi', 'EN' => 'Malawi'),
		 'MV' => array('FR' => 'Maldives', 'EN' => 'Maldives'),
		 'ML' => array('FR' => 'Mali', 'EN' => 'Mali'),
		 'MT' => array('FR' => 'Malte', 'EN' => 'Malta'),
		 'MP' => array('FR' => 'Mariannes du Nord', 'EN' => 'Northern Mariana Islands'),
		 'MQ' => array('FR' => 'Martinique', 'EN' => 'Martinique'),
		 'MU' => array('FR' => 'Maurice', 'EN' => 'Mauritius'),
		 'MR' => array('FR' => 'Mauritanie', 'EN' => 'Mauritania'),
		 'YT' => array('FR' => 'Mayotte', 'EN' => 'Mayotte'),
		 'MX' => array('FR' => 'Mexique', 'EN' => 'Mexico'),
		 'FM' => array('FR' => 'Micronésie', 'EN' => 'Micronesia, Federated States of'),
		 'MD' => array('FR' => 'Moldavie', 'EN' => 'Moldova, Republic of'),
		 'MC' => array('FR' => 'Monaco', 'EN' => 'Monaco'),
		 'MN' => array('FR' => 'Mongolie', 'EN' => 'Mongolia'),
		 'MS' => array('FR' => 'Montserrat', 'EN' => 'Montserrat'),
		 'MZ' => array('FR' => 'Mozambique', 'EN' => 'Mozambique'),
		 'NP' => array('FR' => 'Népal', 'EN' => 'Nepal'),
		 'NA' => array('FR' => 'Namibie', 'EN' => 'Namibia'),
		 'NR' => array('FR' => 'Nauru', 'EN' => 'Nauru'),
		 'NI' => array('FR' => 'Nicaragua', 'EN' => 'Nicaragua'),
		 'NE' => array('FR' => 'Niger', 'EN' => 'Niger'),
		 'NG' => array('FR' => 'Nigeria', 'EN' => 'Nigeria'),
		 'NU' => array('FR' => 'Nioué', 'EN' => 'Niue'),
		 'NO' => array('FR' => 'Norvège', 'EN' => 'Norway'),
		 'NC' => array('FR' => 'Nouvelle-Calédonie', 'EN' => 'New Caledonia'),
		 'NZ' => array('FR' => 'Nouvelle-Zélande', 'EN' => 'New Zealand'),
		 'OM' => array('FR' => 'Oman', 'EN' => 'Oman'),
		 'UG' => array('FR' => 'Ouganda', 'EN' => 'Uganda'),
		 'UZ' => array('FR' => 'Ouzbékistan', 'EN' => 'Uzbekistan'),
		 'PE' => array('FR' => 'Pérou', 'EN' => 'Peru'),
		 'PK' => array('FR' => 'Pakistan', 'EN' => 'Pakistan'),
		 'PA' => array('FR' => 'Panama', 'EN' => 'Panama'),
		 'PG' => array('FR' => 'Papouasie-Nouvelle-Guinée', 'EN' => 'Papua New Guinea'),
		 'PY' => array('FR' => 'Paraguay', 'EN' => 'Paraguay'),
		 'NL' => array('FR' => 'Pays-Bas', 'EN' => 'Netherlands'),
		 'PH' => array('FR' => 'Philippines', 'EN' => 'Philippines'),
		 'PL' => array('FR' => 'Pologne', 'EN' => 'Poland'),
		 'PF' => array('FR' => 'Polynésie française', 'EN' => 'French Polynesia'),
		 'PR' => array('FR' => 'Porto Rico', 'EN' => 'Puerto Rico'),
		 'PT' => array('FR' => 'Portugal', 'EN' => 'Portugal'),
		 'QA' => array('FR' => 'Qatar', 'EN' => 'Qatar'),
		 'CF' => array('FR' => 'République centrafricaine', 'EN' => 'Central African Republic'),
		 'CD' => array('FR' => 'République démocratique du Congo', 'EN' => 'Congo, Democratic Rep. of the'),
		 'DO' => array('FR' => 'République dominicaine', 'EN' => 'Dominican Republic'),
		 'CZ' => array('FR' => 'République tchèque', 'EN' => 'Czech Republic'),
		 'RE' => array('FR' => 'Réunion', 'EN' => 'Reunion'),
		 'RO' => array('FR' => 'Roumanie', 'EN' => 'Romania'),
		 'GB' => array('FR' => 'Royaume-Uni', 'EN' => 'Saint Pierre and Miquelon'),
		 'RU' => array('FR' => 'Russie', 'EN' => 'Russia (Russian Federation)'),
		 'RW' => array('FR' => 'Rwanda', 'EN' => 'Rwanda'),
		 'SN' => array('FR' => 'Sénégal', 'EN' => 'Senegal'),
		 'EH' => array('FR' => 'Sahara occidental', 'EN' => 'Western Sahara'),
		 'KN' => array('FR' => 'Saint-Christophe-et-Niévès', 'EN' => 'Saint Kitts and Nevis'),
		 'SM' => array('FR' => 'Saint-Marin', 'EN' => 'San Marino'),
		 'PM' => array('FR' => 'Saint-Pierre-et-Miquelon', 'EN' => 'Saint Pierre and Miquelon'),
		 'VA' => array('FR' => 'Saint-Siège ', 'EN' => 'Vatican City State (Holy See)'),
		 'VC' => array('FR' => 'Saint-Vincent-et-les-Grenadines', 'EN' => 'Saint Vincent and the Grenadines'),
		 'SH' => array('FR' => 'Sainte-Hélène', 'EN' => 'Saint Helena'),
		 'LC' => array('FR' => 'Sainte-Lucie', 'EN' => 'Saint Lucia'),
		 'SV' => array('FR' => 'Salvador', 'EN' => 'El Salvador'),
		 'WS' => array('FR' => 'Samoa', 'EN' => 'Samoa'),
		 'AS' => array('FR' => 'Samoa américaines', 'EN' => 'American Samoa'),
		 'ST' => array('FR' => 'Sao Tomé-et-Principe', 'EN' => 'Sao Tome and Principe'),
		 'SC' => array('FR' => 'Seychelles', 'EN' => 'Seychelles'),
		 'SL' => array('FR' => 'Sierra Leone', 'EN' => 'Sierra Leone'),
		 'SG' => array('FR' => 'Singapour', 'EN' => 'Singapore'),
		 'SI' => array('FR' => 'Slovénie', 'EN' => 'Slovenia'),
		 'SK' => array('FR' => 'Slovaquie', 'EN' => 'Slovakia'),
		 'SO' => array('FR' => 'Somalie', 'EN' => 'Somalia'),
		 'SD' => array('FR' => 'Soudan', 'EN' => 'Sudan'),
		 'LK' => array('FR' => 'Sri Lanka', 'EN' => 'Sri Lanka (ex-Ceilan)'),
		 'SE' => array('FR' => 'Suède', 'EN' => 'Sweden'),
		 'CH' => array('FR' => 'Suisse', 'EN' => 'Switzerland'),
		 'SR' => array('FR' => 'Suriname', 'EN' => 'Suriname'),
		 'SZ' => array('FR' => 'Swaziland', 'EN' => 'Swaziland'),
		 'SY' => array('FR' => 'Syrie', 'EN' => 'Syrian Arab Republic'),
		 'TW' => array('FR' => 'Taïwan', 'EN' => 'Taiwan'),
		 'TJ' => array('FR' => 'Tadjikistan', 'EN' => 'Tajikistan'),
		 'TZ' => array('FR' => 'Tanzanie', 'EN' => 'Tanzania, United Republic of'),
		 'TD' => array('FR' => 'Tchad', 'EN' => 'Chad'),
		 'TF' => array('FR' => 'Terres australes françaises', 'EN' => 'French Southern Territories - TF'),
		 'IO' => array('FR' => 'Territoire britannique de l\'Océan Indien', 'EN' => 'British Indian Ocean Territory'),
		 'TH' => array('FR' => 'Thaïlande', 'EN' => 'Thailand'),
		 'TL' => array('FR' => 'Timor Oriental', 'EN' => 'Timor-Leste (East Timor)'),
		 'TG' => array('FR' => 'Togo', 'EN' => 'Togo'),
		 'TK' => array('FR' => 'Tokélaou', 'EN' => 'Tokelau'),
		 'TO' => array('FR' => 'Tonga', 'EN' => 'Tonga'),
		 'TT' => array('FR' => 'Trinité-et-Tobago', 'EN' => 'Trinidad & Tobago'),
		 'TN' => array('FR' => 'Tunisie', 'EN' => 'Tunisia'),
		 'TM' => array('FR' => 'Turkménistan', 'EN' => 'Turkmenistan'),
		 'TR' => array('FR' => 'Turquie', 'EN' => 'Turkey'),
		 'TV' => array('FR' => 'Tuvalu', 'EN' => 'Tuvalu'),
		 'UA' => array('FR' => 'Ukraine', 'EN' => 'Ukraine'),
		 'UY' => array('FR' => 'Uruguay', 'EN' => 'Uruguay'),
		 'VU' => array('FR' => 'Vanuatu', 'EN' => 'Vanuatu'),
		 'VE' => array('FR' => 'Venezuela', 'EN' => 'Venezuela'),
		 'VN' => array('FR' => 'Viet Nam', 'EN' => 'Viet Nam'),
		 'WF' => array('FR' => 'Wallis-et-Futuna', 'EN' => 'Wallis and Futuna'),
		 'YE' => array('FR' => 'Yémen', 'EN' => 'Yemen'),
		 'YU' => array('FR' => 'Yougoslavie', 'EN' => 'Saint Pierre and Miquelon'),
		 'ZM' => array('FR' => 'Zambie', 'EN' => 'Zambia'),
		 'ZW' => array('FR' => 'Zimbabwe', 'EN' => 'Zimbabwe'),
		 'MK' => array('FR' => 'ex-République yougoslave de Macédoine', 'EN' => 'Macedonia, TFYR')
		);

	function pays(){
	   $tmp = array() ;
	   foreach($this->pays as $key=>$val) : 
		 $tmp[$key] = $val['FR'] ;
	   endforeach ;
	  return $tmp ; 
	}	
		
	
	
}
?>