<?php
/*
 * This file is part of sokun.
 *
 * sokun is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * sokun is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with sokun. If not, see <http://www.gnu.org/licenses/>.
 */

    //You can change the content of this template
?>
<html lang="fr">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta charset="UTF-8">
    </head>
    <body>
        <h3>{Title}</h3>
        Bienvenue dans sokun {Firstname} {Lastname}. Veuillez utiliser ces identifiants pour <a href="{BaseURL}">vous connecter à l'application</a> :
        <table border="0">
            <tr>
                <td>Identifiant</td><td>{Login}</td>
            </tr>
            <tr>
                <td>Mot de passe</td><td>{Password}</td>
            </tr>            
        </table>
        Une fois connecté, vous pouvez modifier votre mot de passe.
    </body>
</html>
