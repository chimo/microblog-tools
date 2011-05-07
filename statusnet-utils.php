<?php

// Copyright (c) 2011 - Stephane Berube (chimo@chromic.org) http://github.com/chimo/microblog-tools
// Quick and dirty StatusNet utility functions
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

/* TODO
 * Error handling (!)
 * libxml_use_internal_errors(), libxml_clear_errors() -- ?
 * Make more robust/flexible
 * etc.
*/

	class StatusNet {

		public static function getAPIroot($host) {
			// Find the URI to rsd.xml
			$dom = new DOMDocument();
			@$dom->loadHtmlFile($host); // TODO: ensure $host starts with http[s]://
                                        // TODO: ensure we are getting the index page of the site, not some other random page
			$xpath = new DOMXPath($dom);
			$rsd = $xpath->query('/html/head/link[@rel="EditURI"]/@href');

			if(!$rsd || $rsd->length == 0)
				return false;
			
			// Get the rsd.xml file
			$ch = curl_init($rsd->item(0)->nodeValue);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
			$xml = curl_exec($ch);
			curl_close($ch);

			if(!$xml) 
				return false;
			
			// Get the API root
			$dom = new DOMDocument();
			@$dom->loadXML($xml); 
			$xpath = new DOMXPath($dom);
			$xpath->registerNamespace('r', 'http://archipelago.phrasewise.com/rsd');
			$apiRoot = $xpath->query('/r:rsd/r:service/r:apis/r:api[@name="Twitter"]/@apiLink');
			
			if(!$apiRoot || $apiRoot->length == 0)
				return false;
			
			return $apiRoot->item(0)->nodeValue;
		}
		
		public static function getConfigs($apiURI) {
			// Get the config.xml file
			$ch = curl_init($apiURI . "statusnet/config.xml");
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
			$xml = curl_exec($ch);
			curl_close($ch);

			if(!$xml) 
				return false;
			
			// Get the API root
			$dom = new DOMDocument();
			@$dom->loadXML($xml); 
			$xpath = new DOMXPath($dom);
			$textlimit = $xpath->query('/config/site/textlimit');

			if(!$textlimit || $textlimit->length == 0)
				exit("XPath: Can't find textlimit");
				
			$configs = array("textlimit" => $textlimit->item(0)->nodeValue);
			
			return $configs;
		}
	}

?>