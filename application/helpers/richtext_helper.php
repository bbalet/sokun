<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * This file is part of Sokun.
 *
 * Sokun is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Sokun is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Sokun.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Parse HTML content and create Rich Text Content with it (PHPExcel)
 * HTML helper and Excel lib are loaded by caller
 * TODO : Support styling
 * TODO : Numbered list items
 * @param string HTML content
 * @return PHPExcel_RichText RichText Content
 * @author Benjamin BALET <benjamin.balet@gmail.com>
 */
function createRichText($htmlContent) {
        /*$this->load->library('excel');
        $this->load->helper('html');*/
        $domArray = getHtmlDomArray($htmlContent);
        
        $objContext = new stdClass;
        $objContext->bold = FALSE;
        $objContext->italic = FALSE;
        $objContext->underline = FALSE;
        $objContext->strike = FALSE;
       
        $objRichText = new PHPExcel_RichText();
        foreach ($domArray as $token) {
            if ($token['tag']) {
                switch ($token['value']) {
                    case 'strong':
                    case 'b': $objContext->bold = $token['opening']==TRUE?TRUE:FALSE;
                        break;
                    case 'italic':
                    case 'em':
                    case 'i': $objContext->italic = $token['opening']==TRUE?TRUE:FALSE;
                        break;
                    case 'u': $objContext->underline = $token['opening']==TRUE?TRUE:FALSE;
                        break;
                    case 's':
                    case 'strike': $objContext->strike = $token['opening']==TRUE?TRUE:FALSE;
                        break;
                    case 'p': if (!$token['opening']) $objRichText->createText("\n");
                        break;
                    case 'li': 
                        $objContext->underline = $token['opening']==TRUE?$c=' • ':$c="\n";
                        $objRichText->createText($c);
                        break;
                }
                $fgcolor = 'FF' . $token['fgcolor']['R'] . $token['fgcolor']['G'] . $token['fgcolor']['B'];
                //fontname
                //fontsize
                //fontstyle
                //align
                //listtype
            } else {
                if ($token['value'] !='') {
                    $objText = $objRichText->createTextRun($token['value']);
                    $objText->getFont()->setBold($objContext->bold);
                    $objText->getFont()->setItalic($objContext->italic);
                    $objText->getFont()->setUnderline($objContext->underline);
                    $objText->getFont()->setStrikethrough($objContext->strike);
                    //$objText->getFont()->setColor($fgcolor);
                    //setSize()
                }
            }
        }
        return $objRichText;
}

