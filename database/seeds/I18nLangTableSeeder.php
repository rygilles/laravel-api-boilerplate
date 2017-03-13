<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class I18nLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('i18n_lang')->insert([
            [
                'id'			=>'af_NA',
                'description'	=>'Afrikaans (Namibia)'
            ],
            [
                'id'			=>'af_ZA',
                'description'	=>'Afrikaans (South Africa)'
            ],
            [
                'id'			=>'af',
                'description'	=>'Afrikaans'
            ],
            [
                'id'			=>'ak_GH',
                'description'	=>'Akan (Ghana)'
            ],
            [
                'id'			=>'ak',
                'description'	=>'Akan'
            ],
            [
                'id'			=>'sq_AL',
                'description'	=>'Albanian (Albania)'
            ],
            [
                'id'			=>'sq',
                'description'	=>'Albanian'
            ],
            [
                'id'			=>'am_ET',
                'description'	=>'Amharic (Ethiopia)'
            ],
            [
                'id'			=>'am',
                'description'	=>'Amharic'
            ],
            [
                'id'			=>'ar_DZ',
                'description'	=>'Arabic (Algeria)'
            ],
            [
                'id'			=>'ar_BH',
                'description'	=>'Arabic (Bahrain)'
            ],
            [
                'id'			=>'ar_EG',
                'description'	=>'Arabic (Egypt)'
            ],
            [
                'id'			=>'ar_IQ',
                'description'	=>'Arabic (Iraq)'
            ],
            [
                'id'			=>'ar_JO',
                'description'	=>'Arabic (Jordan)'
            ],
            [
                'id'			=>'ar_KW',
                'description'	=>'Arabic (Kuwait)'
            ],
            [
                'id'			=>'ar_LB',
                'description'	=>'Arabic (Lebanon)'
            ],
            [
                'id'			=>'ar_LY',
                'description'	=>'Arabic (Libya)'
            ],
            [
                'id'			=>'ar_MA',
                'description'	=>'Arabic (Morocco)'
            ],
            [
                'id'			=>'ar_OM',
                'description'	=>'Arabic (Oman)'
            ],
            [
                'id'			=>'ar_QA',
                'description'	=>'Arabic (Qatar)'
            ],
            [
                'id'			=>'ar_SA',
                'description'	=>'Arabic (Saudi Arabia)'
            ],
            [
                'id'			=>'ar_SD',
                'description'	=>'Arabic (Sudan)'
            ],
            [
                'id'			=>'ar_SY',
                'description'	=>'Arabic (Syria)'
            ],
            [
                'id'			=>'ar_TN',
                'description'	=>'Arabic (Tunisia)'
            ],
            [
                'id'			=>'ar_AE',
                'description'	=>'Arabic (United Arab Emirates)'
            ],
            [
                'id'			=>'ar_YE',
                'description'	=>'Arabic (Yemen)'
            ],
            [
                'id'			=>'ar',
                'description'	=>'Arabic'
            ],
            [
                'id'			=>'hy_AM',
                'description'	=>'Armenian (Armenia)'
            ],
            [
                'id'			=>'hy',
                'description'	=>'Armenian'
            ],
            [
                'id'			=>'as_IN',
                'description'	=>'Assamese (India)'
            ],
            [
                'id'			=>'as',
                'description'	=>'Assamese'
            ],
            [
                'id'			=>'asa_TZ',
                'description'	=>'Asu (Tanzania)'
            ],
            [
                'id'			=>'asa',
                'description'	=>'Asu'
            ],
            [
                'id'			=>'az_Cyrl',
                'description'	=>'Azerbaijani (Cyrillic)'
            ],
            [
                'id'			=>'az_Cyrl_AZ',
                'description'	=>'Azerbaijani (Cyrillic, Azerbaijan)'
            ],
            [
                'id'			=>'az_Latn',
                'description'	=>'Azerbaijani (Latin)'
            ],
            [
                'id'			=>'az_Latn_AZ',
                'description'	=>'Azerbaijani (Latin, Azerbaijan)'
            ],
            [
                'id'			=>'az',
                'description'	=>'Azerbaijani'
            ],
            [
                'id'			=>'bm_ML',
                'description'	=>'Bambara (Mali)'
            ],
            [
                'id'			=>'bm',
                'description'	=>'Bambara'
            ],
            [
                'id'			=>'eu_ES',
                'description'	=>'Basque (Spain)'
            ],
            [
                'id'			=>'eu',
                'description'	=>'Basque'
            ],
            [
                'id'			=>'be_BY',
                'description'	=>'Belarusian (Belarus)'
            ],
            [
                'id'			=>'be',
                'description'	=>'Belarusian'
            ],
            [
                'id'			=>'bem_ZM',
                'description'	=>'Bemba (Zambia)'
            ],
            [
                'id'			=>'bem',
                'description'	=>'Bemba'
            ],
            [
                'id'			=>'bez_TZ',
                'description'	=>'Bena (Tanzania)'
            ],
            [
                'id'			=>'bez',
                'description'	=>'Bena'
            ],
            [
                'id'			=>'bn_BD',
                'description'	=>'Bengali (Bangladesh)'
            ],
            [
                'id'			=>'bn_IN',
                'description'	=>'Bengali (India)'
            ],
            [
                'id'			=>'bn',
                'description'	=>'Bengali'
            ],
            [
                'id'			=>'bs_BA',
                'description'	=>'Bosnian (Bosnia and Herzegovina)'
            ],
            [
                'id'			=>'bs',
                'description'	=>'Bosnian'
            ],
            [
                'id'			=>'bg_BG',
                'description'	=>'Bulgarian (Bulgaria)'
            ],
            [
                'id'			=>'bg',
                'description'	=>'Bulgarian'
            ],
            [
                'id'			=>'my_MM',
                'description'	=>'Burmese (Myanmar [Burma])'
            ],
            [
                'id'			=>'my',
                'description'	=>'Burmese'
            ],
            [
                'id'			=>'ca_ES',
                'description'	=>'Catalan (Spain)'
            ],
            [
                'id'			=>'ca',
                'description'	=>'Catalan'
            ],
            [
                'id'			=>'tzm_Latn',
                'description'	=>'Central Morocco Tamazight (Latin)'
            ],
            [
                'id'			=>'tzm_Latn_MA',
                'description'	=>'Central Morocco Tamazight (Latin, Morocco)'
            ],
            [
                'id'			=>'tzm',
                'description'	=>'Central Morocco Tamazight'
            ],
            [
                'id'			=>'chr_US',
                'description'	=>'Cherokee (United States)'
            ],
            [
                'id'			=>'chr',
                'description'	=>'Cherokee'
            ],
            [
                'id'			=>'cgg_UG',
                'description'	=>'Chiga (Uganda)'
            ],
            [
                'id'			=>'cgg',
                'description'	=>'Chiga'
            ],
            [
                'id'			=>'zh_Hans',
                'description'	=>'Chinese (Simplified Han)'
            ],
            [
                'id'			=>'zh_Hans_CN',
                'description'	=>'Chinese (Simplified Han, China)'
            ],
            [
                'id'			=>'zh_Hans_HK',
                'description'	=>'Chinese (Simplified Han, Hong Kong SAR China)'
            ],
            [
                'id'			=>'zh_Hans_MO',
                'description'	=>'Chinese (Simplified Han, Macau SAR China)'
            ],
            [
                'id'			=>'zh_Hans_SG',
                'description'	=>'Chinese (Simplified Han, Singapore)'
            ],
            [
                'id'			=>'zh_Hant',
                'description'	=>'Chinese (Traditional Han)'
            ],
            [
                'id'			=>'zh_Hant_HK',
                'description'	=>'Chinese (Traditional Han, Hong Kong SAR China)'
            ],
            [
                'id'			=>'zh_Hant_MO',
                'description'	=>'Chinese (Traditional Han, Macau SAR China)'
            ],
            [
                'id'			=>'zh_Hant_TW',
                'description'	=>'Chinese (Traditional Han, Taiwan)'
            ],
            [
                'id'			=>'zh',
                'description'	=>'Chinese'
            ],
            [
                'id'			=>'kw_GB',
                'description'	=>'Cornish (United Kingdom)'
            ],
            [
                'id'			=>'kw',
                'description'	=>'Cornish'
            ],
            [
                'id'			=>'hr_HR',
                'description'	=>'Croatian (Croatia)'
            ],
            [
                'id'			=>'hr',
                'description'	=>'Croatian'
            ],
            [
                'id'			=>'cs_CZ',
                'description'	=>'Czech (Czech Republic)'
            ],
            [
                'id'			=>'cs',
                'description'	=>'Czech'
            ],
            [
                'id'			=>'da_DK',
                'description'	=>'Danish (Denmark)'
            ],
            [
                'id'			=>'da',
                'description'	=>'Danish'
            ],
            [
                'id'			=>'nl_BE',
                'description'	=>'Dutch (Belgium)'
            ],
            [
                'id'			=>'nl_NL',
                'description'	=>'Dutch (Netherlands)'
            ],
            [
                'id'			=>'nl',
                'description'	=>'Dutch'
            ],
            [
                'id'			=>'ebu_KE',
                'description'	=>'Embu (Kenya)'
            ],
            [
                'id'			=>'ebu',
                'description'	=>'Embu'
            ],
            [
                'id'			=>'en_AS',
                'description'	=>'English (American Samoa)'
            ],
            [
                'id'			=>'en_AU',
                'description'	=>'English (Australia)'
            ],
            [
                'id'			=>'en_BE',
                'description'	=>'English (Belgium)'
            ],
            [
                'id'			=>'en_BZ',
                'description'	=>'English (Belize)'
            ],
            [
                'id'			=>'en_BW',
                'description'	=>'English (Botswana)'
            ],
            [
                'id'			=>'en_CA',
                'description'	=>'English (Canada)'
            ],
            [
                'id'			=>'en_GU',
                'description'	=>'English (Guam)'
            ],
            [
                'id'			=>'en_HK',
                'description'	=>'English (Hong Kong SAR China)'
            ],
            [
                'id'			=>'en_IN',
                'description'	=>'English (India)'
            ],
            [
                'id'			=>'en_IE',
                'description'	=>'English (Ireland)'
            ],
            [
                'id'			=>'en_JM',
                'description'	=>'English (Jamaica)'
            ],
            [
                'id'			=>'en_MT',
                'description'	=>'English (Malta)'
            ],
            [
                'id'			=>'en_MH',
                'description'	=>'English (Marshall Islands)'
            ],
            [
                'id'			=>'en_MU',
                'description'	=>'English (Mauritius)'
            ],
            [
                'id'			=>'en_NA',
                'description'	=>'English (Namibia)'
            ],
            [
                'id'			=>'en_NZ',
                'description'	=>'English (New Zealand)'
            ],
            [
                'id'			=>'en_MP',
                'description'	=>'English (Northern Mariana Islands)'
            ],
            [
                'id'			=>'en_PK',
                'description'	=>'English (Pakistan)'
            ],
            [
                'id'			=>'en_PH',
                'description'	=>'English (Philippines)'
            ],
            [
                'id'			=>'en_SG',
                'description'	=>'English (Singapore)'
            ],
            [
                'id'			=>'en_ZA',
                'description'	=>'English (South Africa)'
            ],
            [
                'id'			=>'en_TT',
                'description'	=>'English (Trinidad and Tobago)'
            ],
            [
                'id'			=>'en_UM',
                'description'	=>'English (U.S. Minor Outlying Islands)'
            ],
            [
                'id'			=>'en_VI',
                'description'	=>'English (U.S. Virgin Islands)'
            ],
            [
                'id'			=>'en_GB',
                'description'	=>'English (United Kingdom)'
            ],
            [
                'id'			=>'en_US',
                'description'	=>'English (United States)'
            ],
            [
                'id'			=>'en_ZW',
                'description'	=>'English (Zimbabwe)'
            ],
            [
                'id'			=>'en',
                'description'	=>'English'
            ],
            [
                'id'			=>'eo',
                'description'	=>'Esperanto'
            ],
            [
                'id'			=>'et_EE',
                'description'	=>'Estonian (Estonia)'
            ],
            [
                'id'			=>'et',
                'description'	=>'Estonian'
            ],
            [
                'id'			=>'ee_GH',
                'description'	=>'Ewe (Ghana)'
            ],
            [
                'id'			=>'ee_TG',
                'description'	=>'Ewe (Togo)'
            ],
            [
                'id'			=>'ee',
                'description'	=>'Ewe'
            ],
            [
                'id'			=>'fo_FO',
                'description'	=>'Faroese (Faroe Islands)'
            ],
            [
                'id'			=>'fo',
                'description'	=>'Faroese'
            ],
            [
                'id'			=>'fil_PH',
                'description'	=>'Filipino (Philippines)'
            ],
            [
                'id'			=>'fil',
                'description'	=>'Filipino'
            ],
            [
                'id'			=>'fi_FI',
                'description'	=>'Finnish (Finland)'
            ],
            [
                'id'			=>'fi',
                'description'	=>'Finnish'
            ],
            [
                'id'			=>'fr_BE',
                'description'	=>'French (Belgium)'
            ],
            [
                'id'			=>'fr_BJ',
                'description'	=>'French (Benin)'
            ],
            [
                'id'			=>'fr_BF',
                'description'	=>'French (Burkina Faso)'
            ],
            [
                'id'			=>'fr_BI',
                'description'	=>'French (Burundi)'
            ],
            [
                'id'			=>'fr_CM',
                'description'	=>'French (Cameroon)'
            ],
            [
                'id'			=>'fr_CA',
                'description'	=>'French (Canada)'
            ],
            [
                'id'			=>'fr_CF',
                'description'	=>'French (Central African Republic)'
            ],
            [
                'id'			=>'fr_TD',
                'description'	=>'French (Chad)'
            ],
            [
                'id'			=>'fr_KM',
                'description'	=>'French (Comoros)'
            ],
            [
                'id'			=>'fr_CG',
                'description'	=>'French (Congo - Brazzaville)'
            ],
            [
                'id'			=>'fr_CD',
                'description'	=>'French (Congo - Kinshasa)'
            ],
            [
                'id'			=>'fr_CI',
                'description'	=>'French (Côte d’Ivoire)'
            ],
            [
                'id'			=>'fr_DJ',
                'description'	=>'French (Djibouti)'
            ],
            [
                'id'			=>'fr_GQ',
                'description'	=>'French (Equatorial Guinea)'
            ],
            [
                'id'			=>'fr_FR',
                'description'	=>'French (France)'
            ],
            [
                'id'			=>'fr_GA',
                'description'	=>'French (Gabon)'
            ],
            [
                'id'			=>'fr_GP',
                'description'	=>'French (Guadeloupe)'
            ],
            [
                'id'			=>'fr_GN',
                'description'	=>'French (Guinea)'
            ],
            [
                'id'			=>'fr_LU',
                'description'	=>'French (Luxembourg)'
            ],
            [
                'id'			=>'fr_MG',
                'description'	=>'French (Madagascar)'
            ],
            [
                'id'			=>'fr_ML',
                'description'	=>'French (Mali)'
            ],
            [
                'id'			=>'fr_MQ',
                'description'	=>'French (Martinique)'
            ],
            [
                'id'			=>'fr_MC',
                'description'	=>'French (Monaco)'
            ],
            [
                'id'			=>'fr_NE',
                'description'	=>'French (Niger)'
            ],
            [
                'id'			=>'fr_RW',
                'description'	=>'French (Rwanda)'
            ],
            [
                'id'			=>'fr_RE',
                'description'	=>'French (Réunion)'
            ],
            [
                'id'			=>'fr_BL',
                'description'	=>'French (Saint Barthélemy)'
            ],
            [
                'id'			=>'fr_MF',
                'description'	=>'French (Saint Martin)'
            ],
            [
                'id'			=>'fr_SN',
                'description'	=>'French (Senegal)'
            ],
            [
                'id'			=>'fr_CH',
                'description'	=>'French (Switzerland)'
            ],
            [
                'id'			=>'fr_TG',
                'description'	=>'French (Togo)'
            ],
            [
                'id'			=>'fr',
                'description'	=>'French'
            ],
            [
                'id'			=>'ff_SN',
                'description'	=>'Fulah (Senegal)'
            ],
            [
                'id'			=>'ff',
                'description'	=>'Fulah'
            ],
            [
                'id'			=>'gl_ES',
                'description'	=>'Galician (Spain)'
            ],
            [
                'id'			=>'gl',
                'description'	=>'Galician'
            ],
            [
                'id'			=>'lg_UG',
                'description'	=>'Ganda (Uganda)'
            ],
            [
                'id'			=>'lg',
                'description'	=>'Ganda'
            ],
            [
                'id'			=>'ka_GE',
                'description'	=>'Georgian (Georgia)'
            ],
            [
                'id'			=>'ka',
                'description'	=>'Georgian'
            ],
            [
                'id'			=>'de_AT',
                'description'	=>'German (Austria)'
            ],
            [
                'id'			=>'de_BE',
                'description'	=>'German (Belgium)'
            ],
            [
                'id'			=>'de_DE',
                'description'	=>'German (Germany)'
            ],
            [
                'id'			=>'de_LI',
                'description'	=>'German (Liechtenstein)'
            ],
            [
                'id'			=>'de_LU',
                'description'	=>'German (Luxembourg)'
            ],
            [
                'id'			=>'de_CH',
                'description'	=>'German (Switzerland)'
            ],
            [
                'id'			=>'de',
                'description'	=>'German'
            ],
            [
                'id'			=>'el_CY',
                'description'	=>'Greek (Cyprus)'
            ],
            [
                'id'			=>'el_GR',
                'description'	=>'Greek (Greece)'
            ],
            [
                'id'			=>'el',
                'description'	=>'Greek'
            ],
            [
                'id'			=>'gu_IN',
                'description'	=>'Gujarati (India)'
            ],
            [
                'id'			=>'gu',
                'description'	=>'Gujarati'
            ],
            [
                'id'			=>'guz_KE',
                'description'	=>'Gusii (Kenya)'
            ],
            [
                'id'			=>'guz',
                'description'	=>'Gusii'
            ],
            [
                'id'			=>'ha_Latn',
                'description'	=>'Hausa (Latin)'
            ],
            [
                'id'			=>'ha_Latn_GH',
                'description'	=>'Hausa (Latin, Ghana)'
            ],
            [
                'id'			=>'ha_Latn_NE',
                'description'	=>'Hausa (Latin, Niger)'
            ],
            [
                'id'			=>'ha_Latn_NG',
                'description'	=>'Hausa (Latin, Nigeria)'
            ],
            [
                'id'			=>'ha',
                'description'	=>'Hausa'
            ],
            [
                'id'			=>'haw_US',
                'description'	=>'Hawaiian (United States)'
            ],
            [
                'id'			=>'haw',
                'description'	=>'Hawaiian'
            ],
            [
                'id'			=>'he_IL',
                'description'	=>'Hebrew (Israel)'
            ],
            [
                'id'			=>'he',
                'description'	=>'Hebrew'
            ],
            [
                'id'			=>'hi_IN',
                'description'	=>'Hindi (India)'
            ],
            [
                'id'			=>'hi',
                'description'	=>'Hindi'
            ],
            [
                'id'			=>'hu_HU',
                'description'	=>'Hungarian (Hungary)'
            ],
            [
                'id'			=>'hu',
                'description'	=>'Hungarian'
            ],
            [
                'id'			=>'is_IS',
                'description'	=>'Icelandic (Iceland)'
            ],
            [
                'id'			=>'is',
                'description'	=>'Icelandic'
            ],
            [
                'id'			=>'ig_NG',
                'description'	=>'Igbo (Nigeria)'
            ],
            [
                'id'			=>'ig',
                'description'	=>'Igbo'
            ],
            [
                'id'			=>'id_ID',
                'description'	=>'Indonesian (Indonesia)'
            ],
            [
                'id'			=>'id',
                'description'	=>'Indonesian'
            ],
            [
                'id'			=>'ga_IE',
                'description'	=>'Irish (Ireland)'
            ],
            [
                'id'			=>'ga',
                'description'	=>'Irish'
            ],
            [
                'id'			=>'it_IT',
                'description'	=>'Italian (Italy)'
            ],
            [
                'id'			=>'it_CH',
                'description'	=>'Italian (Switzerland)'
            ],
            [
                'id'			=>'it',
                'description'	=>'Italian'
            ],
            [
                'id'			=>'ja_JP',
                'description'	=>'Japanese (Japan)'
            ],
            [
                'id'			=>'ja',
                'description'	=>'Japanese'
            ],
            [
                'id'			=>'kea_CV',
                'description'	=>'Kabuverdianu (Cape Verde)'
            ],
            [
                'id'			=>'kea',
                'description'	=>'Kabuverdianu'
            ],
            [
                'id'			=>'kab_DZ',
                'description'	=>'Kabyle (Algeria)'
            ],
            [
                'id'			=>'kab',
                'description'	=>'Kabyle'
            ],
            [
                'id'			=>'kl_GL',
                'description'	=>'Kalaallisut (Greenland)'
            ],
            [
                'id'			=>'kl',
                'description'	=>'Kalaallisut'
            ],
            [
                'id'			=>'kln_KE',
                'description'	=>'Kalenjin (Kenya)'
            ],
            [
                'id'			=>'kln',
                'description'	=>'Kalenjin'
            ],
            [
                'id'			=>'kam_KE',
                'description'	=>'Kamba (Kenya)'
            ],
            [
                'id'			=>'kam',
                'description'	=>'Kamba'
            ],
            [
                'id'			=>'kn_IN',
                'description'	=>'Kannada (India)'
            ],
            [
                'id'			=>'kn',
                'description'	=>'Kannada'
            ],
            [
                'id'			=>'kk_Cyrl',
                'description'	=>'Kazakh (Cyrillic)'
            ],
            [
                'id'			=>'kk_Cyrl_KZ',
                'description'	=>'Kazakh (Cyrillic, Kazakhstan)'
            ],
            [
                'id'			=>'kk',
                'description'	=>'Kazakh'
            ],
            [
                'id'			=>'km_KH',
                'description'	=>'Khmer (Cambodia)'
            ],
            [
                'id'			=>'km',
                'description'	=>'Khmer'
            ],
            [
                'id'			=>'ki_KE',
                'description'	=>'Kikuyu (Kenya)'
            ],
            [
                'id'			=>'ki',
                'description'	=>'Kikuyu'
            ],
            [
                'id'			=>'rw_RW',
                'description'	=>'Kinyarwanda (Rwanda)'
            ],
            [
                'id'			=>'rw',
                'description'	=>'Kinyarwanda'
            ],
            [
                'id'			=>'kok_IN',
                'description'	=>'Konkani (India)'
            ],
            [
                'id'			=>'kok',
                'description'	=>'Konkani'
            ],
            [
                'id'			=>'ko_KR',
                'description'	=>'Korean (South Korea)'
            ],
            [
                'id'			=>'ko',
                'description'	=>'Korean'
            ],
            [
                'id'			=>'khq_ML',
                'description'	=>'Koyra Chiini (Mali)'
            ],
            [
                'id'			=>'khq',
                'description'	=>'Koyra Chiini'
            ],
            [
                'id'			=>'ses_ML',
                'description'	=>'Koyraboro Senni (Mali)'
            ],
            [
                'id'			=>'ses',
                'description'	=>'Koyraboro Senni'
            ],
            [
                'id'			=>'lag_TZ',
                'description'	=>'Langi (Tanzania)'
            ],
            [
                'id'			=>'lag',
                'description'	=>'Langi'
            ],
            [
                'id'			=>'lv_LV',
                'description'	=>'Latvian (Latvia)'
            ],
            [
                'id'			=>'lv',
                'description'	=>'Latvian'
            ],
            [
                'id'			=>'lt_LT',
                'description'	=>'Lithuanian (Lithuania)'
            ],
            [
                'id'			=>'lt',
                'description'	=>'Lithuanian'
            ],
            [
                'id'			=>'luo_KE',
                'description'	=>'Luo (Kenya)'
            ],
            [
                'id'			=>'luo',
                'description'	=>'Luo'
            ],
            [
                'id'			=>'luy_KE',
                'description'	=>'Luyia (Kenya)'
            ],
            [
                'id'			=>'luy',
                'description'	=>'Luyia'
            ],
            [
                'id'			=>'mk_MK',
                'description'	=>'Macedonian (Macedonia)'
            ],
            [
                'id'			=>'mk',
                'description'	=>'Macedonian'
            ],
            [
                'id'			=>'jmc_TZ',
                'description'	=>'Machame (Tanzania)'
            ],
            [
                'id'			=>'jmc',
                'description'	=>'Machame'
            ],
            [
                'id'			=>'kde_TZ',
                'description'	=>'Makonde (Tanzania)'
            ],
            [
                'id'			=>'kde',
                'description'	=>'Makonde'
            ],
            [
                'id'			=>'mg_MG',
                'description'	=>'Malagasy (Madagascar)'
            ],
            [
                'id'			=>'mg',
                'description'	=>'Malagasy'
            ],
            [
                'id'			=>'ms_BN',
                'description'	=>'Malay (Brunei)'
            ],
            [
                'id'			=>'ms_MY',
                'description'	=>'Malay (Malaysia)'
            ],
            [
                'id'			=>'ms',
                'description'	=>'Malay'
            ],
            [
                'id'			=>'ml_IN',
                'description'	=>'Malayalam (India)'
            ],
            [
                'id'			=>'ml',
                'description'	=>'Malayalam'
            ],
            [
                'id'			=>'mt_MT',
                'description'	=>'Maltese (Malta)'
            ],
            [
                'id'			=>'mt',
                'description'	=>'Maltese'
            ],
            [
                'id'			=>'gv_GB',
                'description'	=>'Manx (United Kingdom)'
            ],
            [
                'id'			=>'gv',
                'description'	=>'Manx'
            ],
            [
                'id'			=>'mr_IN',
                'description'	=>'Marathi (India)'
            ],
            [
                'id'			=>'mr',
                'description'	=>'Marathi'
            ],
            [
                'id'			=>'mas_KE',
                'description'	=>'Masai (Kenya)'
            ],
            [
                'id'			=>'mas_TZ',
                'description'	=>'Masai (Tanzania)'
            ],
            [
                'id'			=>'mas',
                'description'	=>'Masai'
            ],
            [
                'id'			=>'mer_KE',
                'description'	=>'Meru (Kenya)'
            ],
            [
                'id'			=>'mer',
                'description'	=>'Meru'
            ],
            [
                'id'			=>'mfe_MU',
                'description'	=>'Morisyen (Mauritius)'
            ],
            [
                'id'			=>'mfe',
                'description'	=>'Morisyen'
            ],
            [
                'id'			=>'naq_NA',
                'description'	=>'Nama (Namibia)'
            ],
            [
                'id'			=>'naq',
                'description'	=>'Nama'
            ],
            [
                'id'			=>'ne_IN',
                'description'	=>'Nepali (India)'
            ],
            [
                'id'			=>'ne_NP',
                'description'	=>'Nepali (Nepal)'
            ],
            [
                'id'			=>'ne',
                'description'	=>'Nepali'
            ],
            [
                'id'			=>'nd_ZW',
                'description'	=>'North Ndebele (Zimbabwe)'
            ],
            [
                'id'			=>'nd',
                'description'	=>'North Ndebele'
            ],
            [
                'id'			=>'nb_NO',
                'description'	=>'Norwegian Bokmål (Norway)'
            ],
            [
                'id'			=>'nb',
                'description'	=>'Norwegian Bokmål'
            ],
            [
                'id'			=>'nn_NO',
                'description'	=>'Norwegian Nynorsk (Norway)'
            ],
            [
                'id'			=>'nn',
                'description'	=>'Norwegian Nynorsk'
            ],
            [
                'id'			=>'nyn_UG',
                'description'	=>'Nyankole (Uganda)'
            ],
            [
                'id'			=>'nyn',
                'description'	=>'Nyankole'
            ],
            [
                'id'			=>'or_IN',
                'description'	=>'Oriya (India)'
            ],
            [
                'id'			=>'or',
                'description'	=>'Oriya'
            ],
            [
                'id'			=>'om_ET',
                'description'	=>'Oromo (Ethiopia)'
            ],
            [
                'id'			=>'om_KE',
                'description'	=>'Oromo (Kenya)'
            ],
            [
                'id'			=>'om',
                'description'	=>'Oromo'
            ],
            [
                'id'			=>'ps_AF',
                'description'	=>'Pashto (Afghanistan)'
            ],
            [
                'id'			=>'ps',
                'description'	=>'Pashto'
            ],
            [
                'id'			=>'fa_AF',
                'description'	=>'Persian (Afghanistan)'
            ],
            [
                'id'			=>'fa_IR',
                'description'	=>'Persian (Iran)'
            ],
            [
                'id'			=>'fa',
                'description'	=>'Persian'
            ],
            [
                'id'			=>'pl_PL',
                'description'	=>'Polish (Poland)'
            ],
            [
                'id'			=>'pl',
                'description'	=>'Polish'
            ],
            [
                'id'			=>'pt_BR',
                'description'	=>'Portuguese (Brazil)'
            ],
            [
                'id'			=>'pt_GW',
                'description'	=>'Portuguese (Guinea-Bissau)'
            ],
            [
                'id'			=>'pt_MZ',
                'description'	=>'Portuguese (Mozambique)'
            ],
            [
                'id'			=>'pt_PT',
                'description'	=>'Portuguese (Portugal)'
            ],
            [
                'id'			=>'pt',
                'description'	=>'Portuguese'
            ],
            [
                'id'			=>'pa_Arab',
                'description'	=>'Punjabi (Arabic)'
            ],
            [
                'id'			=>'pa_Arab_PK',
                'description'	=>'Punjabi (Arabic, Pakistan)'
            ],
            [
                'id'			=>'pa_Guru',
                'description'	=>'Punjabi (Gurmukhi)'
            ],
            [
                'id'			=>'pa_Guru_IN',
                'description'	=>'Punjabi (Gurmukhi, India)'
            ],
            [
                'id'			=>'pa',
                'description'	=>'Punjabi'
            ],
            [
                'id'			=>'ro_MD',
                'description'	=>'Romanian (Moldova)'
            ],
            [
                'id'			=>'ro_RO',
                'description'	=>'Romanian (Romania)'
            ],
            [
                'id'			=>'ro',
                'description'	=>'Romanian'
            ],
            [
                'id'			=>'rm_CH',
                'description'	=>'Romansh (Switzerland)'
            ],
            [
                'id'			=>'rm',
                'description'	=>'Romansh'
            ],
            [
                'id'			=>'rof_TZ',
                'description'	=>'Rombo (Tanzania)'
            ],
            [
                'id'			=>'rof',
                'description'	=>'Rombo'
            ],
            [
                'id'			=>'ru_MD',
                'description'	=>'Russian (Moldova)'
            ],
            [
                'id'			=>'ru_RU',
                'description'	=>'Russian (Russia)'
            ],
            [
                'id'			=>'ru_UA',
                'description'	=>'Russian (Ukraine)'
            ],
            [
                'id'			=>'ru',
                'description'	=>'Russian'
            ],
            [
                'id'			=>'rwk_TZ',
                'description'	=>'Rwa (Tanzania)'
            ],
            [
                'id'			=>'rwk',
                'description'	=>'Rwa'
            ],
            [
                'id'			=>'saq_KE',
                'description'	=>'Samburu (Kenya)'
            ],
            [
                'id'			=>'saq',
                'description'	=>'Samburu'
            ],
            [
                'id'			=>'sg_CF',
                'description'	=>'Sango (Central African Republic)'
            ],
            [
                'id'			=>'sg',
                'description'	=>'Sango'
            ],
            [
                'id'			=>'seh_MZ',
                'description'	=>'Sena (Mozambique)'
            ],
            [
                'id'			=>'seh',
                'description'	=>'Sena'
            ],
            [
                'id'			=>'sr_Cyrl',
                'description'	=>'Serbian (Cyrillic)'
            ],
            [
                'id'			=>'sr_Cyrl_BA',
                'description'	=>'Serbian (Cyrillic, Bosnia and Herzegovina)'
            ],
            [
                'id'			=>'sr_Cyrl_ME',
                'description'	=>'Serbian (Cyrillic, Montenegro)'
            ],
            [
                'id'			=>'sr_Cyrl_RS',
                'description'	=>'Serbian (Cyrillic, Serbia)'
            ],
            [
                'id'			=>'sr_Latn',
                'description'	=>'Serbian (Latin)'
            ],
            [
                'id'			=>'sr_Latn_BA',
                'description'	=>'Serbian (Latin, Bosnia and Herzegovina)'
            ],
            [
                'id'			=>'sr_Latn_ME',
                'description'	=>'Serbian (Latin, Montenegro)'
            ],
            [
                'id'			=>'sr_Latn_RS',
                'description'	=>'Serbian (Latin, Serbia)'
            ],
            [
                'id'			=>'sr',
                'description'	=>'Serbian'
            ],
            [
                'id'			=>'sn_ZW',
                'description'	=>'Shona (Zimbabwe)'
            ],
            [
                'id'			=>'sn',
                'description'	=>'Shona'
            ],
            [
                'id'			=>'ii_CN',
                'description'	=>'Sichuan Yi (China)'
            ],
            [
                'id'			=>'ii',
                'description'	=>'Sichuan Yi'
            ],
            [
                'id'			=>'si_LK',
                'description'	=>'Sinhala (Sri Lanka)'
            ],
            [
                'id'			=>'si',
                'description'	=>'Sinhala'
            ],
            [
                'id'			=>'sk_SK',
                'description'	=>'Slovak (Slovakia)'
            ],
            [
                'id'			=>'sk',
                'description'	=>'Slovak'
            ],
            [
                'id'			=>'sl_SI',
                'description'	=>'Slovenian (Slovenia)'
            ],
            [
                'id'			=>'sl',
                'description'	=>'Slovenian'
            ],
            [
                'id'			=>'xog_UG',
                'description'	=>'Soga (Uganda)'
            ],
            [
                'id'			=>'xog',
                'description'	=>'Soga'
            ],
            [
                'id'			=>'so_DJ',
                'description'	=>'Somali (Djibouti)'
            ],
            [
                'id'			=>'so_ET',
                'description'	=>'Somali (Ethiopia)'
            ],
            [
                'id'			=>'so_KE',
                'description'	=>'Somali (Kenya)'
            ],
            [
                'id'			=>'so_SO',
                'description'	=>'Somali (Somalia)'
            ],
            [
                'id'			=>'so',
                'description'	=>'Somali'
            ],
            [
                'id'			=>'es_AR',
                'description'	=>'Spanish (Argentina)'
            ],
            [
                'id'			=>'es_BO',
                'description'	=>'Spanish (Bolivia)'
            ],
            [
                'id'			=>'es_CL',
                'description'	=>'Spanish (Chile)'
            ],
            [
                'id'			=>'es_CO',
                'description'	=>'Spanish (Colombia)'
            ],
            [
                'id'			=>'es_CR',
                'description'	=>'Spanish (Costa Rica)'
            ],
            [
                'id'			=>'es_DO',
                'description'	=>'Spanish (Dominican Republic)'
            ],
            [
                'id'			=>'es_EC',
                'description'	=>'Spanish (Ecuador)'
            ],
            [
                'id'			=>'es_SV',
                'description'	=>'Spanish (El Salvador)'
            ],
            [
                'id'			=>'es_GQ',
                'description'	=>'Spanish (Equatorial Guinea)'
            ],
            [
                'id'			=>'es_GT',
                'description'	=>'Spanish (Guatemala)'
            ],
            [
                'id'			=>'es_HN',
                'description'	=>'Spanish (Honduras)'
            ],
            [
                'id'			=>'es_419',
                'description'	=>'Spanish (Latin America)'
            ],
            [
                'id'			=>'es_MX',
                'description'	=>'Spanish (Mexico)'
            ],
            [
                'id'			=>'es_NI',
                'description'	=>'Spanish (Nicaragua)'
            ],
            [
                'id'			=>'es_PA',
                'description'	=>'Spanish (Panama)'
            ],
            [
                'id'			=>'es_PY',
                'description'	=>'Spanish (Paraguay)'
            ],
            [
                'id'			=>'es_PE',
                'description'	=>'Spanish (Peru)'
            ],
            [
                'id'			=>'es_PR',
                'description'	=>'Spanish (Puerto Rico)'
            ],
            [
                'id'			=>'es_ES',
                'description'	=>'Spanish (Spain)'
            ],
            [
                'id'			=>'es_US',
                'description'	=>'Spanish (United States)'
            ],
            [
                'id'			=>'es_UY',
                'description'	=>'Spanish (Uruguay)'
            ],
            [
                'id'			=>'es_VE',
                'description'	=>'Spanish (Venezuela)'
            ],
            [
                'id'			=>'es',
                'description'	=>'Spanish'
            ],
            [
                'id'			=>'sw_KE',
                'description'	=>'Swahili (Kenya)'
            ],
            [
                'id'			=>'sw_TZ',
                'description'	=>'Swahili (Tanzania)'
            ],
            [
                'id'			=>'sw',
                'description'	=>'Swahili'
            ],
            [
                'id'			=>'sv_FI',
                'description'	=>'Swedish (Finland)'
            ],
            [
                'id'			=>'sv_SE',
                'description'	=>'Swedish (Sweden)'
            ],
            [
                'id'			=>'sv',
                'description'	=>'Swedish'
            ],
            [
                'id'			=>'gsw_CH',
                'description'	=>'Swiss German (Switzerland)'
            ],
            [
                'id'			=>'gsw',
                'description'	=>'Swiss German'
            ],
            [
                'id'			=>'shi_Latn',
                'description'	=>'Tachelhit (Latin)'
            ],
            [
                'id'			=>'shi_Latn_MA',
                'description'	=>'Tachelhit (Latin, Morocco)'
            ],
            [
                'id'			=>'shi_Tfng',
                'description'	=>'Tachelhit (Tifinagh)'
            ],
            [
                'id'			=>'shi_Tfng_MA',
                'description'	=>'Tachelhit (Tifinagh, Morocco)'
            ],
            [
                'id'			=>'shi',
                'description'	=>'Tachelhit'
            ],
            [
                'id'			=>'dav_KE',
                'description'	=>'Taita (Kenya)'
            ],
            [
                'id'			=>'dav',
                'description'	=>'Taita'
            ],
            [
                'id'			=>'ta_IN',
                'description'	=>'Tamil (India)'
            ],
            [
                'id'			=>'ta_LK',
                'description'	=>'Tamil (Sri Lanka)'
            ],
            [
                'id'			=>'ta',
                'description'	=>'Tamil'
            ],
            [
                'id'			=>'te_IN',
                'description'	=>'Telugu (India)'
            ],
            [
                'id'			=>'te',
                'description'	=>'Telugu'
            ],
            [
                'id'			=>'teo_KE',
                'description'	=>'Teso (Kenya)'
            ],
            [
                'id'			=>'teo_UG',
                'description'	=>'Teso (Uganda)'
            ],
            [
                'id'			=>'teo',
                'description'	=>'Teso'
            ],
            [
                'id'			=>'th_TH',
                'description'	=>'Thai (Thailand)'
            ],
            [
                'id'			=>'th',
                'description'	=>'Thai'
            ],
            [
                'id'			=>'bo_CN',
                'description'	=>'Tibetan (China)'
            ],
            [
                'id'			=>'bo_IN',
                'description'	=>'Tibetan (India)'
            ],
            [
                'id'			=>'bo',
                'description'	=>'Tibetan'
            ],
            [
                'id'			=>'ti_ER',
                'description'	=>'Tigrinya (Eritrea)'
            ],
            [
                'id'			=>'ti_ET',
                'description'	=>'Tigrinya (Ethiopia)'
            ],
            [
                'id'			=>'ti',
                'description'	=>'Tigrinya'
            ],
            [
                'id'			=>'to_TO',
                'description'	=>'Tonga (Tonga)'
            ],
            [
                'id'			=>'to',
                'description'	=>'Tonga'
            ],
            [
                'id'			=>'tr_TR',
                'description'	=>'Turkish (Turkey)'
            ],
            [
                'id'			=>'tr',
                'description'	=>'Turkish'
            ],
            [
                'id'			=>'uk_UA',
                'description'	=>'Ukrainian (Ukraine)'
            ],
            [
                'id'			=>'uk',
                'description'	=>'Ukrainian'
            ],
            [
                'id'			=>'ur_IN',
                'description'	=>'Urdu (India)'
            ],
            [
                'id'			=>'ur_PK',
                'description'	=>'Urdu (Pakistan)'
            ],
            [
                'id'			=>'ur',
                'description'	=>'Urdu'
            ],
            [
                'id'			=>'uz_Arab',
                'description'	=>'Uzbek (Arabic)'
            ],
            [
                'id'			=>'uz_Arab_AF',
                'description'	=>'Uzbek (Arabic, Afghanistan)'
            ],
            [
                'id'			=>'uz_Cyrl',
                'description'	=>'Uzbek (Cyrillic)'
            ],
            [
                'id'			=>'uz_Cyrl_UZ',
                'description'	=>'Uzbek (Cyrillic, Uzbekistan)'
            ],
            [
                'id'			=>'uz_Latn',
                'description'	=>'Uzbek (Latin)'
            ],
            [
                'id'			=>'uz_Latn_UZ',
                'description'	=>'Uzbek (Latin, Uzbekistan)'
            ],
            [
                'id'			=>'uz',
                'description'	=>'Uzbek'
            ],
            [
                'id'			=>'vi_VN',
                'description'	=>'Vietnamese (Vietnam)'
            ],
            [
                'id'			=>'vi',
                'description'	=>'Vietnamese'
            ],
            [
                'id'			=>'vun_TZ',
                'description'	=>'Vunjo (Tanzania)'
            ],
            [
                'id'			=>'vun',
                'description'	=>'Vunjo'
            ],
            [
                'id'			=>'cy_GB',
                'description'	=>'Welsh (United Kingdom)'
            ],
            [
                'id'			=>'cy',
                'description'	=>'Welsh'
            ],
            [
                'id'			=>'yo_NG',
                'description'	=>'Yoruba (Nigeria)'
            ],
            [
                'id'			=>'yo',
                'description'	=>'Yoruba'
            ],
            [
                'id'			=>'zu_ZA',
                'description'	=>'Zulu (South Africa)'
            ],
            [
                'id'			=>'zu',
                'description'	=>'Zulu'
            ]
        ]);
    }
}
