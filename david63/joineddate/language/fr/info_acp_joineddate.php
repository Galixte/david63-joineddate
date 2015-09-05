<?php
/**
*
* Joined date format extension for the phpBB Forum Software package.
* French translation by Galixte (http://www.galixte.com)
*
* @copyright (c) 2015 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'CUSTOM_DATEFORMAT'				=> 'Personnalisé…',

	'JOINED_DATE_FORMAT'			=> 'Format de la date d’inscription',
	'JOINED_DATE_FORMAT_EXPLAIN'	=> 'Sur cette page il est possible de paramétrer le format de la date de l’information : « Enregistré le » qui sera affiché dans les sujets, la liste des membres et les profils.',
	'JOINED_DATE_LOG'				=> '<strong>Le format de date d’inscription a été mis à jour.</strong>',

	'MEMBERLIST_FORMAT'				=> 'Format de date d’inscription pour la liste des membres',
	'MEMBERLIST_FORMAT_EXPLAIN'		=> 'Permet de paramétrer le format de la date de l’information : « Enregistré le » qui sera affiché dans la liste des membres.<br />Laisser vide pour utiliser le format de la date par défaut de l’utilisateur.',

	'PROFILE_FORMAT'				=> 'Format de date d’inscription pour les profils',
	'PROFILE_FORMAT_EXPLAIN'		=> 'Permet de paramétrer le format de la date de l’information : « Enregistré le » qui sera affiché dans les profils.<br />Laisser vide pour utiliser le format de la date par défaut de l’utilisateur.',

	'VIEWTOPIC_FORMAT'				=> 'Format de date d’inscription pour les sujets',
	'VIEWTOPIC_FORMAT_EXPLAIN'		=> 'Permet de paramétrer le format de la date de l’information : « Enregistré le » qui sera affiché dans les sujets.<br />Laisser vide pour utiliser le format de la date par défaut de l’utilisateur.',

	'dateformats'	=> array_merge($lang['dateformats'], array(
		'F Y'		=> 'janvier 2008',
		'd F Y'		=> '1 janvier 2008',
		'|F Y|'		=> 'Aujourd’hui / janvier 2008',
		'|d F Y|'	=> 'Aujourd’hui / 1 janvier 2008',
	)),
));
