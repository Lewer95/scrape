<?php

$regex_address_mail = "/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.(?!png|jpg|gif|webp|progressive|pdf|svg)[a-zA-Z]{2,20}/";
$regex_exclude_mail = "/(@sentry-next.wixpress.com|your-email@shopify.com|@newsletter.com|web.archive.org|http\:|https\:|@sentry.|sentry.io|@sentry-new.|@sentry10.wixpress.com|@sentry.wixpress.com|yourname@|@adresse-e-mail.com|youremailaddress@here.com|youremail@|@sentry.shoplazza|@error-tracking.zipify.com|exemple@mail.com|@yourwebsite.com|@yourstorename.com|test@boosterapps.net|@example.|[x]+.com|xxx@yyy.zzz|[x]+@[x]+.[x]+|you@gmail.com|@emailaddress.com|your@mail.com|your@email.address|team@latofonts.com|@2x.heic|@yourstore.com|@2x.|your@email.here|your@gmail.com|venedor-shop@gmail.com|@group.calendar.google.com|@courriel.com|your@emailaddress.com|@sample.com|@your-site.com|@yousite.com|@email.com|sample@gmail.com|shop@store.uk|shellashopify2018@gmail.com|support@mpthemes.net|support@heliumdev.com|jan.novak@server.cz|joe@voorbeeld.com|kilatechapps@gmail.com|[[:<:]]ula@gmail\.com[[:>:]]|kisjanos@pelda.hu|joe@eksempel.com|support@halothemes.com|mariorossi@esempio.it|wsparcie@cyberfolks.pl|sprzedaz@shoper.pl|abuse@ovh.net|info@gmail.com|@twojsklep.pl|@demos.com|kontakt@aftermarket.pl|peter@beispielemai.de|support@gist-apps.com|@company.site|pomoc@sstore.pl|prosze@uzupelnic.pl|@app.getsentry.com|support@starapps.studio|lorem@ipsum.com|support@simprosys.com|support@themeforshop.com|@support.com|adresemail@firma.pl|@your-domain.com|@beispiel.com|@mail.com|mllegeorgesand@gmail.com|demo@posthemes.com|@shop.myshop|@yourbrand.com|@exemple.com|hello@dream-theme.com|@yoursite.com|yourmail@com.com|email@ejemplo.com|@email.pl|@somemail.com|hi@beeketing.com|@demo.com|help@moz.com|hello@shineon.com|hello@gmail.com|user@gmail.com|impallari@gmail.com|username@gmail.com|@company.com|jan@kowalski.pl|you@your-email.com|example@gmail.com|@addresshere.com|exemplo@gmail.com|exemple@votredomaine.com|@seuemail.com|@seudominio.com|no-replay@cstore.pl|@twoja-domena.pl|you@youremailaddress.com|typesetit@att.net|you@yourname.com|filler@godaddy.com|examplo@gmail.com|you@yours.com|your_email@your.com|@template.|@address.com|vendor@|vendors@|@twojdomena.pl|your@email.com|customercare@solidbrush.com|@nomdusite.com|@sualoja.com|@eksempel.com|@exampledemo.com|@exemplo.com|email@gmail.com|yourmail@com.com|abc@xyz.com|name@email.com|@domena.pl|@gk1ra.uf|@przyklad.pl|rodo@formaster.com|test@test.co.uk|you@email.co.uk|@yourcompany.com|email@email.com|sandbox.salesforce.com|info@outofthesandbox.com|donate@opencart.com|@site.com|@mydomain.com|@yourdomain.com|@youremail.com|helpdesk@customerservicebest.com|license@prestashop.com|contact@prestashop.com|info@cookie-compliance.co.uk|tech@202-ecommerce.com|@abc.xyz|@0.8.9.js|.min.js|@website.com|@test.com|john@doe.com|@my-domain.|@mysite.|@mystore.com|@youremaildomain.com|@domain.|@example.com|.print[[:>:]]|.svg[[:>:]]|.js[[:>:]]|.png[[:>:]]|.jpg[[:>:]]|.gif[[:>:]]|.webp[[:>:]]|.jpeg[[:>:]])/u";


function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}

function filtr_number_phone($tel_nr){
	
	//oczyszczenie numeru tel
	//usunięcie (0)
	$tel_nr = str_replace("(0)","",$tel_nr);
	$tel_digit = preg_replace('/\D/', '', $tel_nr);
	$len_tel = strlen($tel_digit);
	
	//usuniecie nr typu 123456789, 000000000, 111111111, ... , 999999999
	$check_wrong_number = "/123456789|234567890|234567891|[0]{9}|[1]{9}|[2]{9}|[3]{9}|[4]{9}|[5]{9}|[6]{9}|[7]{9}|[8]{9}|[9]{9}/";
	if(preg_match($check_wrong_number,substr($tel_digit, -9))) $tel_digit = "";
	$check_number_tel = "";
	
	//PL
	/*
	$regex_check_number = "/(12|13|14|15|16|17|18|22|23|24|25|26|29|32|33|34|41|42|43|44|46|47|48|52|54|55|56|58|59|61|62|63|65|67|68|71|74|75|76|77|81|82|83|84|85|86|87|89|91|94|95)[0-9]{7}|(45|50|51|53|57|60|66|69|72|73|78|79|88)[0-9]{7}|(800|801)[0-9]{6}/";
	if($len_tel == 9)
	{
		if(preg_match($regex_check_number,$tel_digit)) $check_number_tel = "48".$tel_digit;
	}
	elseif($len_tel > 9)
	{
		$base_tel = substr($tel_digit, -9);
		$country_tel = substr($tel_digit, 0, -9);
		if(preg_match($regex_check_number,$base_tel) && ($country_tel == "48" || $country_tel == "048" || $country_tel == "0048")) $check_number_tel = "48".$base_tel;
	}
	else{}
	*/
	
	//US
	
	$regex_check_number = "/[2-9]{1}[0-9]{9}/";
	if($len_tel == 10)
	{
		if(preg_match($regex_check_number,$tel_digit)) $check_number_tel = "1".$tel_digit;
	}
	elseif($len_tel > 10)
	{
		$base_tel = substr($tel_digit, -10);
		$country_tel = substr($tel_digit, 0, -10);
		if(preg_match($regex_check_number,$base_tel) && ($country_tel == "1" || $country_tel == "01" || $country_tel == "001")) $check_number_tel = "1".$base_tel;
	}
	else{}
	//wykluczenie wysp (Lista wykluczeń: American Samoa, Anguilla, Antigua and Barbuda, Bahamas, Barbados, Bermuda, British Virgin Islands, Cayman Islands, Dominica, Dominican Republic, Grenada, Guam, Jamaica, Montserrat, Northern Mariana Islands, Puerto Rico, Saint Kitts and Nevis, Saint Lucia, Saint Vincent and the Grenadines, Sint Maarten, Trinidad and Tobago, Turks and Caicos Islands, United States Virgin Islands)
	if($check_number_tel != ""){
		
		$check_is_us_ca_number = substr($check_number_tel, 0, 4);
		if($check_is_us_ca_number == '1684' ||  $check_is_us_ca_number == '1264' ||  $check_is_us_ca_number == '1268' ||  $check_is_us_ca_number == '1242' ||  $check_is_us_ca_number == '1246' ||  $check_is_us_ca_number == '1441' ||  $check_is_us_ca_number == '1284' ||  $check_is_us_ca_number == '1345' ||  $check_is_us_ca_number == '1767' ||  $check_is_us_ca_number == '1809' ||  $check_is_us_ca_number == '1829' ||  $check_is_us_ca_number == '1849' ||  $check_is_us_ca_number == '1473' ||  $check_is_us_ca_number == '1671' ||  $check_is_us_ca_number == '1876' ||  $check_is_us_ca_number == '1658' ||  $check_is_us_ca_number == '1664' ||  $check_is_us_ca_number == '1670' ||  $check_is_us_ca_number == '1787' ||  $check_is_us_ca_number == '1939' ||  $check_is_us_ca_number == '1869' ||  $check_is_us_ca_number == '1758' ||  $check_is_us_ca_number == '1784' ||  $check_is_us_ca_number == '1721' ||  $check_is_us_ca_number == '1868' ||  $check_is_us_ca_number == '1649' ||  $check_is_us_ca_number == '1340') $check_number_tel = "";
		
	}else{}
	
	if($check_number_tel != ""){
        $timezone_nr = substr($check_number_tel, 0, 4);
        switch($timezone_nr){
                case '1201': $timezone='EST'; break;
                case '1202': $timezone='EST'; break;
                case '1203': $timezone='EST'; break;
                case '1205': $timezone='CST'; break;
                case '1206': $timezone='PST'; break;
                case '1207': $timezone='EST'; break;
                case '1208': $timezone='MST'; break;
                case '1209': $timezone='PST'; break;
                case '1210': $timezone='CST'; break;
                case '1212': $timezone='EST'; break;
                case '1213': $timezone='PST'; break;
                case '1214': $timezone='CST'; break;
                case '1215': $timezone='EST'; break;
                case '1216': $timezone='EST'; break;
                case '1217': $timezone='CST'; break;
                case '1218': $timezone='CST'; break;
                case '1219': $timezone='CST'; break;
                case '1220': $timezone='EST'; break;
                case '1223': $timezone='EST'; break;
                case '1224': $timezone='CST'; break;
                case '1225': $timezone='CST'; break;
                case '1228': $timezone='CST'; break;
                case '1229': $timezone='EST'; break;
                case '1231': $timezone='EST'; break;
                case '1234': $timezone='EST'; break;
                case '1239': $timezone='EST'; break;
                case '1240': $timezone='EST'; break;
                case '1248': $timezone='EST'; break;
                case '1251': $timezone='CST'; break;
                case '1252': $timezone='EST'; break;
                case '1253': $timezone='PST'; break;
                case '1254': $timezone='CST'; break;
                case '1256': $timezone='CST'; break;
                case '1260': $timezone='EST'; break;
                case '1262': $timezone='CST'; break;
                case '1267': $timezone='EST'; break;
                case '1269': $timezone='EST'; break;
                case '1270': $timezone='CST'; break;
                case '1272': $timezone='EST'; break;
                case '1276': $timezone='EST'; break;
                case '1279': $timezone='PST'; break;
                case '1281': $timezone='CST'; break;
                case '1301': $timezone='EST'; break;
                case '1302': $timezone='EST'; break;
                case '1303': $timezone='MST'; break;
                case '1304': $timezone='EST'; break;
                case '1305': $timezone='EST'; break;
                case '1307': $timezone='MST'; break;
                case '1308': $timezone='CST'; break;
                case '1309': $timezone='CST'; break;
                case '1310': $timezone='PST'; break;
                case '1312': $timezone='CST'; break;
                case '1313': $timezone='EST'; break;
                case '1314': $timezone='CST'; break;
                case '1315': $timezone='EST'; break;
                case '1316': $timezone='CST'; break;
                case '1317': $timezone='EST'; break;
                case '1318': $timezone='CST'; break;
                case '1319': $timezone='CST'; break;
                case '1320': $timezone='CST'; break;
                case '1321': $timezone='EST'; break;
                case '1323': $timezone='PST'; break;
                case '1325': $timezone='CST'; break;
                case '1326': $timezone='EST'; break;
                case '1330': $timezone='EST'; break;
                case '1331': $timezone='CST'; break;
                case '1332': $timezone='EST'; break;
                case '1334': $timezone='CST'; break;
                case '1336': $timezone='EST'; break;
                case '1337': $timezone='CST'; break;
                case '1339': $timezone='EST'; break;
                case '1341': $timezone='PST'; break;
                case '1346': $timezone='CST'; break;
                case '1347': $timezone='EST'; break;
                case '1351': $timezone='EST'; break;
                case '1352': $timezone='EST'; break;
                case '1360': $timezone='PST'; break;
                case '1361': $timezone='CST'; break;
                case '1364': $timezone='CST'; break;
                case '1380': $timezone='EST'; break;
                case '1385': $timezone='MST'; break;
                case '1386': $timezone='EST'; break;
                case '1401': $timezone='EST'; break;
                case '1402': $timezone='CST'; break;
                case '1404': $timezone='EST'; break;
                case '1405': $timezone='CST'; break;
                case '1406': $timezone='MST'; break;
                case '1407': $timezone='EST'; break;
                case '1408': $timezone='PST'; break;
                case '1409': $timezone='CST'; break;
                case '1410': $timezone='EST'; break;
                case '1412': $timezone='EST'; break;
                case '1413': $timezone='EST'; break;
                case '1414': $timezone='CST'; break;
                case '1415': $timezone='PST'; break;
                case '1417': $timezone='CST'; break;
                case '1419': $timezone='EST'; break;
                case '1423': $timezone='EST'; break;
                case '1424': $timezone='PST'; break;
                case '1425': $timezone='PST'; break;
                case '1430': $timezone='CST'; break;
                case '1432': $timezone='CST'; break;
                case '1434': $timezone='EST'; break;
                case '1435': $timezone='MST'; break;
                case '1440': $timezone='EST'; break;
                case '1442': $timezone='PST'; break;
                case '1443': $timezone='EST'; break;
                case '1445': $timezone='EST'; break;
                case '1447': $timezone='CST'; break;
                case '1448': $timezone='CST'; break;
                case '1456': $timezone=''; break;
                case '1458': $timezone='PST'; break;
                case '1463': $timezone='EST'; break;
                case '1464': $timezone='CST'; break;
                case '1469': $timezone='CST'; break;
                case '1470': $timezone='EST'; break;
                case '1475': $timezone='EST'; break;
                case '1478': $timezone='EST'; break;
                case '1479': $timezone='CST'; break;
                case '1480': $timezone='MST'; break;
                case '1484': $timezone='EST'; break;
                case '1500': $timezone=''; break;
                case '1501': $timezone='CST'; break;
                case '1502': $timezone='EST'; break;
                case '1503': $timezone='PST'; break;
                case '1504': $timezone='CST'; break;
                case '1505': $timezone='MST'; break;
                case '1507': $timezone='CST'; break;
                case '1508': $timezone='EST'; break;
                case '1509': $timezone='PST'; break;
                case '1510': $timezone='PST'; break;
                case '1512': $timezone='CST'; break;
                case '1513': $timezone='EST'; break;
                case '1515': $timezone='CST'; break;
                case '1516': $timezone='EST'; break;
                case '1517': $timezone='EST'; break;
                case '1518': $timezone='EST'; break;
                case '1520': $timezone='MST'; break;
                case '1521': $timezone=''; break;
                case '1522': $timezone=''; break;
                case '1523': $timezone=''; break;
                case '1524': $timezone=''; break;
                case '1530': $timezone='PST'; break;
                case '1531': $timezone='CST'; break;
                case '1533': $timezone=''; break;
                case '1534': $timezone='CST'; break;
                case '1539': $timezone='CST'; break;
                case '1540': $timezone='EST'; break;
                case '1541': $timezone='PST'; break;
                case '1544': $timezone=''; break;
                case '1551': $timezone='EST'; break;
                case '1559': $timezone='PST'; break;
                case '1561': $timezone='EST'; break;
                case '1562': $timezone='PST'; break;
                case '1563': $timezone='CST'; break;
                case '1564': $timezone='PST'; break;
                case '1566': $timezone=''; break;
                case '1567': $timezone='EST'; break;
                case '1570': $timezone='EST'; break;
                case '1571': $timezone='EST'; break;
                case '1572': $timezone='CST'; break;
                case '1573': $timezone='CST'; break;
                case '1574': $timezone='EST'; break;
                case '1575': $timezone='MST'; break;
                case '1580': $timezone='CST'; break;
                case '1582': $timezone='EST'; break;
                case '1585': $timezone='EST'; break;
                case '1586': $timezone='EST'; break;
                case '1588': $timezone=''; break;
                case '1601': $timezone='CST'; break;
                case '1602': $timezone='MST'; break;
                case '1603': $timezone='EST'; break;
                case '1605': $timezone='CST'; break;
                case '1606': $timezone='EST'; break;
                case '1607': $timezone='EST'; break;
                case '1608': $timezone='CST'; break;
                case '1609': $timezone='EST'; break;
                case '1610': $timezone='EST'; break;
                case '1611': $timezone=''; break;
                case '1612': $timezone='CST'; break;
                case '1614': $timezone='EST'; break;
                case '1615': $timezone='CST'; break;
                case '1616': $timezone='EST'; break;
                case '1617': $timezone='EST'; break;
                case '1618': $timezone='CST'; break;
                case '1619': $timezone='PST'; break;
                case '1620': $timezone='CST'; break;
                case '1623': $timezone='MST'; break;
                case '1626': $timezone='PST'; break;
                case '1628': $timezone='PST'; break;
                case '1629': $timezone='CST'; break;
                case '1630': $timezone='CST'; break;
                case '1631': $timezone='EST'; break;
                case '1636': $timezone='CST'; break;
                case '1640': $timezone='EST'; break;
                case '1641': $timezone='CST'; break;
                case '1646': $timezone='EST'; break;
                case '1650': $timezone='PST'; break;
                case '1651': $timezone='CST'; break;
                case '1657': $timezone='PST'; break;
                case '1659': $timezone='CST'; break;
                case '1660': $timezone='CST'; break;
                case '1661': $timezone='PST'; break;
                case '1662': $timezone='CST'; break;
                case '1667': $timezone='EST'; break;
                case '1669': $timezone='PST'; break;
                case '1678': $timezone='EST'; break;
                case '1680': $timezone='EST'; break;
                case '1681': $timezone='EST'; break;
                case '1682': $timezone='CST'; break;
                case '1689': $timezone='EST'; break;
                case '1700': $timezone=''; break;
                case '1701': $timezone='CST'; break;
                case '1702': $timezone='PST'; break;
                case '1703': $timezone='EST'; break;
                case '1704': $timezone='EST'; break;
                case '1706': $timezone='EST'; break;
                case '1707': $timezone='PST'; break;
                case '1708': $timezone='CST'; break;
                case '1710': $timezone=''; break;
                case '1712': $timezone='CST'; break;
                case '1713': $timezone='CST'; break;
                case '1714': $timezone='PST'; break;
                case '1715': $timezone='CST'; break;
                case '1716': $timezone='EST'; break;
                case '1717': $timezone='EST'; break;
                case '1718': $timezone='EST'; break;
                case '1719': $timezone='MST'; break;
                case '1720': $timezone='MST'; break;
                case '1724': $timezone='EST'; break;
                case '1725': $timezone='PST'; break;
                case '1726': $timezone='CST'; break;
                case '1727': $timezone='EST'; break;
                case '1731': $timezone='CST'; break;
                case '1732': $timezone='EST'; break;
                case '1734': $timezone='EST'; break;
                case '1737': $timezone='CST'; break;
                case '1740': $timezone='EST'; break;
                case '1743': $timezone='EST'; break;
                case '1747': $timezone='PST'; break;
                case '1754': $timezone='EST'; break;
                case '1757': $timezone='EST'; break;
                case '1760': $timezone='PST'; break;
                case '1762': $timezone='EST'; break;
                case '1763': $timezone='CST'; break;
                case '1765': $timezone='EST'; break;
                case '1769': $timezone='CST'; break;
                case '1770': $timezone='EST'; break;
                case '1771': $timezone='EST'; break;
                case '1772': $timezone='EST'; break;
                case '1773': $timezone='CST'; break;
                case '1774': $timezone='EST'; break;
                case '1775': $timezone='PST'; break;
                case '1779': $timezone='CST'; break;
                case '1781': $timezone='EST'; break;
                case '1785': $timezone='CST'; break;
                case '1786': $timezone='EST'; break;
                case '1800': $timezone=''; break;
                case '1801': $timezone='MST'; break;
                case '1802': $timezone='EST'; break;
                case '1803': $timezone='EST'; break;
                case '1804': $timezone='EST'; break;
                case '1805': $timezone='PST'; break;
                case '1806': $timezone='CST'; break;
                case '1808': $timezone='HAST'; break;
                case '1810': $timezone='EST'; break;
                case '1812': $timezone='EST'; break;
                case '1813': $timezone='EST'; break;
                case '1814': $timezone='EST'; break;
                case '1815': $timezone='CST'; break;
                case '1816': $timezone='CST'; break;
                case '1817': $timezone='CST'; break;
                case '1818': $timezone='PST'; break;
                case '1820': $timezone='PST'; break;
                case '1828': $timezone='EST'; break;
                case '1830': $timezone='CST'; break;
                case '1831': $timezone='PST'; break;
                case '1832': $timezone='CST'; break;
                case '1833': $timezone=''; break;
                case '1838': $timezone='EST'; break;
                case '1839': $timezone='EST'; break;
                case '1840': $timezone='PST'; break;
                case '1843': $timezone='EST'; break;
                case '1844': $timezone=''; break;
                case '1845': $timezone='EST'; break;
                case '1847': $timezone='CST'; break;
                case '1848': $timezone='EST'; break;
                case '1850': $timezone='CST'; break;
                case '1854': $timezone='EST'; break;
                case '1855': $timezone=''; break;
                case '1856': $timezone='EST'; break;
                case '1857': $timezone='EST'; break;
                case '1858': $timezone='PST'; break;
                case '1859': $timezone='EST'; break;
                case '1860': $timezone='EST'; break;
                case '1862': $timezone='EST'; break;
                case '1863': $timezone='EST'; break;
                case '1864': $timezone='EST'; break;
                case '1865': $timezone='EST'; break;
                case '1866': $timezone=''; break;
                case '1870': $timezone='CST'; break;
                case '1872': $timezone='CST'; break;
                case '1877': $timezone=''; break;
                case '1878': $timezone='EST'; break;
                case '1880': $timezone=''; break;
                case '1881': $timezone=''; break;
                case '1888': $timezone=''; break;
                case '1900': $timezone=''; break;
                case '1901': $timezone='CST'; break;
                case '1903': $timezone='CST'; break;
                case '1904': $timezone='EST'; break;
                case '1906': $timezone='EST'; break;
                case '1907': $timezone='AKST'; break;
                case '1908': $timezone='EST'; break;
                case '1909': $timezone='PST'; break;
                case '1910': $timezone='EST'; break;
                case '1912': $timezone='EST'; break;
                case '1913': $timezone='CST'; break;
                case '1914': $timezone='EST'; break;
                case '1915': $timezone='MST'; break;
                case '1916': $timezone='PST'; break;
                case '1917': $timezone='EST'; break;
                case '1918': $timezone='CST'; break;
                case '1919': $timezone='EST'; break;
                case '1920': $timezone='CST'; break;
                case '1925': $timezone='PST'; break;
                case '1928': $timezone='MST'; break;
                case '1929': $timezone='EST'; break;
                case '1930': $timezone='EST'; break;
                case '1931': $timezone='CST'; break;
                case '1934': $timezone='EST'; break;
                case '1936': $timezone='CST'; break;
                case '1937': $timezone='EST'; break;
                case '1938': $timezone='CST'; break;
                case '1940': $timezone='CST'; break;
                case '1941': $timezone='EST'; break;
                case '1945': $timezone='CST'; break;
                case '1947': $timezone='EST'; break;
                case '1949': $timezone='PST'; break;
                case '1951': $timezone='PST'; break;
                case '1952': $timezone='CST'; break;
                case '1954': $timezone='EST'; break;
                case '1956': $timezone='CST'; break;
                case '1959': $timezone='EST'; break;
                case '1970': $timezone='MST'; break;
                case '1971': $timezone='PST'; break;
                case '1972': $timezone='CST'; break;
                case '1973': $timezone='EST'; break;
                case '1978': $timezone='EST'; break;
                case '1979': $timezone='CST'; break;
                case '1980': $timezone='EST'; break;
                case '1984': $timezone='EST'; break;
                case '1985': $timezone='CST'; break;
                case '1986': $timezone='MST'; break;
                case '1989': $timezone='EST'; break;
                case '1204': $timezone='CST'; break;
                case '1226': $timezone='EST'; break;
                case '1236': $timezone='PST'; break;
                case '1249': $timezone='EST'; break;
                case '1250': $timezone='PST'; break;
                case '1289': $timezone='EST'; break;
                case '1306': $timezone='CST'; break;
                case '1343': $timezone='EST'; break;
                case '1365': $timezone='EST'; break;
                case '1367': $timezone='EST'; break;
                case '1403': $timezone='MST'; break;
                case '1416': $timezone='EST'; break;
                case '1418': $timezone='EST'; break;
                case '1431': $timezone='CST'; break;
                case '1437': $timezone='EST'; break;
                case '1438': $timezone='EST'; break;
                case '1450': $timezone='EST'; break;
                case '1474': $timezone='MST'; break;
                case '1506': $timezone='AST'; break;
                case '1514': $timezone='EST'; break;
                case '1519': $timezone='EST'; break;
                case '1548': $timezone='EST'; break;
                case '1579': $timezone='EST'; break;
                case '1581': $timezone='EST'; break;
                case '1587': $timezone='MST'; break;
                case '1604': $timezone='PST'; break;
                case '1613': $timezone='EST'; break;
                case '1622': $timezone=''; break;
                case '1639': $timezone='MST'; break;
                case '1647': $timezone='EST'; break;
                case '1672': $timezone='PST'; break;
                case '1705': $timezone='EST'; break;
                case '1709': $timezone='ADT'; break;
                case '1742': $timezone='EST'; break;
                case '1778': $timezone='PST'; break;
                case '1780': $timezone='MST'; break;
                case '1782': $timezone='AST'; break;
                case '1807': $timezone='EST'; break;
                case '1819': $timezone='EST'; break;
                case '1825': $timezone='MST'; break;
                case '1867': $timezone='PST'; break;
                case '1873': $timezone='EST'; break;
                case '1902': $timezone='AST'; break;
                case '1905': $timezone='EST'; break;
                default: $timezone='';
            }
            
            $check_number_tel = $check_number_tel.":".$timezone;
    }
    else{}
	
	
	
	//UK
	/*
	$regex_check_number_10 = "/[1235789]{1}[0-9]{9}/";
	$regex_check_number_9 = "/[18]{1}[0-9]{8}/";
	
	//usuniecie zer z początku nr tel
	$delete_zero = 0;
	$delete_check = false;
	for($xx = 0 ; $xx < ($len_tel-1); $xx++){
		$check_digit = $tel_digit[$xx];
		if(intval($check_digit) == 0 && $delete_check == false) $delete_zero++;
		if(intval($check_digit) != 0 && $delete_check == false) $delete_check = true;
	}
	if($delete_zero > 0) $tel_digit = substr($tel_digit, $delete_zero);
	$len_tel = strlen($tel_digit);
	
	//check UK foramt
	if($len_tel == 9)
	{
		if(preg_match($regex_check_number_9,$tel_digit)) $check_number_tel = "44".$tel_digit;
	}
	if($len_tel == 10)
	{
		if(preg_match($regex_check_number_10,$tel_digit)) $check_number_tel = "44".$tel_digit;
	}
	elseif($len_tel > 10)
	{
		$country_tel = substr($tel_digit, 0, 2);
		$base_tel = substr($tel_digit, 2);
		if($country_tel == "44") 
		{
			//$check_number_tel = $tel_digit;
			
			$delete_zero = 0;
			for($xx = 0 ; $xx < ((strlen($base_tel))-1); $xx++){
				$check_digit = $base_tel[$xx];
				if(intval($check_digit) == 0 && $delete_check == false) $delete_zero++;
				if(intval($check_digit) != 0 && $delete_check == false) $delete_check = true;
			}
			if($delete_zero > 0) $base_tel = substr($base_tel, $delete_zero);
			$check_number_tel = "44".$base_tel;
			
		}
		else{}
	}
	else{}
	*/
	
	return $check_number_tel;
	
	//dodanie na początku nr kierunkowego Kanada +1, US +1, UK +44, AUS +61, NZ +64, PL +48
	
	
}

function search_tel($out_html_contact, $name_site) {
	$regex_tel = '/tel:(.*)/';
	$array_tel = [];
	$dom2 = new DOMDocument();
	$dom2->loadHTML($out_html_contact);
	$xpath = new DOMXPath($dom2);
	
	$xpath->registerNamespace("php", "http://php.net/xpath"); 
	$xpath->registerPhpFunctions('preg_match');
	
	$hyperlink_tel = $xpath->query("//a[php:functionString('preg_match', '$regex_tel', @href)>0]/@href");
	//$hyperlink_tel = $xpath->query("//a/@href");
	
	//Zapisywanie nr tel:
		foreach ($hyperlink_tel as $element) {
			$nodes = $element->childNodes;
			foreach ($nodes as $node) {
				//echo $node->nodeValue;
				//$scrape_nr_tel = preg_replace('/[^0-9]/', '', $node->nodeValue);
				//array_push($array_tel,['tel'=>$scrape_nr_tel,'site'=>$name_site]);
				
				$tel_string = str_replace("%20","",$node->nodeValue);
				$tel_string = str_replace("-","",$tel_string);
				$tel_string = str_replace("(","",$tel_string);
				$tel_string = str_replace(")","",$tel_string);
				$tel_string = str_replace(".","",$tel_string);
				$tel_string = str_replace(" ","",$tel_string);
				
				preg_match_all('/[0-9]+/', $tel_string, $scrape_nr_tel, PREG_SET_ORDER);
				foreach ($scrape_nr_tel as list($scrape_nr_tel_)) {
					array_push($array_tel,['tel'=>$scrape_nr_tel_,'site'=>$name_site]);
				}
				
			}
		}
		//usuwanie duplikatów telefonów
		$array_tel = unique_multidim_array($array_tel,'tel');
		return $array_tel;
}


function search_mail($out_html_contact, $name_site) {
	$regex_mail = '/mailto:(.*)/';
	$array_mail = [];
	$dom2 = new DOMDocument();
	$dom2->loadHTML($out_html_contact);
	$xpath = new DOMXPath($dom2);
	
	$xpath->registerNamespace("php", "http://php.net/xpath"); 
	$xpath->registerPhpFunctions('preg_match');
	
	$hyperlink_mail = $xpath->query("//a[php:functionString('preg_match', '$regex_mail', @href)>0]/@href");
	
	//Zapisywanie mail
		foreach ($hyperlink_mail as $element) {
			$nodes = $element->childNodes;
			foreach ($nodes as $node) {
				
				$mail_string = strtolower($node->nodeValue); 
				$mail_string = str_replace("mailto:","",$mail_string);
				$mail_string = str_replace("%20","",$mail_string);
				$mail_string = str_replace("%22","",$mail_string);
				$mail_string = str_replace("%C2","",$mail_string);
				$mail_string = str_replace("%A0","",$mail_string);
				$mail_string = str_replace("%80","",$mail_string);
				$mail_string = str_replace("%8B","",$mail_string);
				$mail_string = str_replace("%E2","",$mail_string);
				$mail_string = str_replace("%93","",$mail_string);
				$mail_string = str_replace("%3C","",$mail_string);
				$mail_string = preg_replace("!\s+!"," ",str_replace(array("\n\r", "\n", "\r", PHP_EOL),"",str_replace("|"," ",$mail_string)));
				$temp_string_mail = explode("?",$mail_string);
				$temp_string_mail2 = explode("&",$temp_string_mail[0]);
				$mail_string = $temp_string_mail2[0];
				global $regex_address_mail;
				global $regex_exclude_mail;
				if(preg_match($regex_address_mail,$mail_string) && !preg_match($regex_exclude_mail,$mail_string)) array_push($array_mail,['mail'=>$mail_string,'site'=>$name_site]);

			}
		}
		//usuwanie duplikatów e-mail
		$array_mail = unique_multidim_array($array_mail,'mail');
		return $array_mail;
}


?>

<?php

error_reporting(0);

$f1 = 'scrape_tel_result.txt';
$f2 = 'scrape_tel_agin_to_scrapers.txt';
$f3 = 'scrape_mail_result.txt';
$f4 = 'scrape_domain_down.txt';
$f5 = 'scrape_time_check.txt';

$file_result = fopen($f1, 'a');
$file_again_to_scrapers = fopen($f2, 'a');
$file_mail_result = fopen($f3, 'a');
$file_domain_down = fopen($f4, 'a');
$file_time_check = fopen($f5, 'a');

					
	
	$ch = curl_init();	
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_HTTPGET, 1);
	curl_setopt ($ch, CURLOPT_HEADER, 0);
	curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	

	
	$baza_opinie;
		
	$dom = new DOMDocument();
		

		$url=$_POST['url'];
		//$url = "buk.gmina.pl";
		
		
		//echo "<td>".$fraza[0]."</td>";
		
		curl_setopt($ch, CURLOPT_URL, trim($url));
		curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 1);   // cancel if below 1 byte/second
		curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 60);   // for a period of 30 seconds
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$out_html = curl_exec($ch);
		$out_html = str_replace('&nbsp;',' ',$out_html);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$last_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		
		if ($httpcode != 200){
			curl_setopt($ch, CURLOPT_URL, "https://".trim($url));
			$out_html = curl_exec($ch);
			$out_html = str_replace('&nbsp;',' ',$out_html);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$last_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		}else{}
		
		

		
		$temp_domain = str_replace("http://","",$last_url);
		$temp_domain = str_replace("https://","",$temp_domain);
		$temp_domain = str_replace("www.","",$temp_domain);
		$temp_domain = explode("/",$temp_domain);
		$url_file_txt = $temp_domain[0];
		
		
		$url_domain = $url;
		$http_code = $httpcode;
		$url_docelowe = $last_url;
		
		$dom->loadHTML($out_html);
		$xpath = new DOMXPath($dom);
		
		$opinion = "";
		$result = "";
		
		$meta_title = $xpath->evaluate('string(//title)');
		$meta_desc = $xpath->evaluate('string(//meta[@name="description"]/@content)');

		//$meta_title = $xpath->getElementsByTagName('title');
		/*$metas = $dom->getElementsByTagName('meta');
		foreach ($metas as $tag) {
			if ($tag->getAttribute('name')=="description" || $tag->getAttribute('name')=="DESCRIPTION" || $tag->getAttribute('name')=="Description"){$meta_desc=$tag->getAttribute('content');}
			else{}
		}
		*/
		$meta_title = preg_replace("!\s+!"," ",str_replace(array("\n\r", "\n", "\r", PHP_EOL),"",str_replace("|","-",$meta_title)));
		$meta_desc = preg_replace("!\s+!"," ",str_replace(array("\n\r", "\n", "\r", PHP_EOL),"",str_replace("|","-",$meta_desc)));
		
		$meta_title = str_replace('"','',$meta_title);
		$meta_desc = str_replace('"','',$meta_desc);
		
		if(strlen($meta_title)>200) $meta_title = substr($meta_title,0,200);
		if(strlen($meta_desc)>400) $meta_desc = substr($meta_desc,0,400);
		
		//Filtrowanie title i meta desc
		//wykluczenie dla
		// chińskie i hinduskie znaki - https://www.regular-expressions.info/unicode.html
		$regex_filter_words = "/ovhcloud accompagne votre|call buydomains at 844\-896\-7299|domain is for sale \- buy with epik| \– opening soon|opening soon\–|403 forbidden|welcome to fastcomet cloud hosting|is for sale \- hugedomains|forsale lander|bluehost \- top rated web hosting|church|seo agency|digital agency|marketing agency|google ads|webdevelopment|web developers|copywriting|college|university|universities|technology institute|high school|hospital|magazine|foundation|museum|casino|restaurant|blog|\p{Han}+|\p{Hangul}+|\p{Arabic}+|\p{Katakana}+|\p{Thai}+|\p{Cyrillic}+|\p{Devanagari}+/u";
		
		$stop_check = false;
		if(preg_match($regex_filter_words,strtolower($meta_title)) || preg_match($regex_filter_words,strtolower($meta_desc))) $stop_check = true; $httpcode = $httpcode."(F)";
		
		if ($httpcode == 200 && $stop_check == false){
		
		//$result = $xpath->evaluate('string(//div[@class="seo_desc"])');
		//$opinion = $xpath->evaluate('string(//span[@class="count"])');
		//$czy_promocja = $xpath->evaluate('string(//span[@class="ribbon ribbon--single-product-page ribbon--promotion"])');
		
		$xpath->registerNamespace("php", "http://php.net/xpath"); 
		$xpath->registerPhpFunctions('preg_match');
		
		$regex_tel = '/tel:(.*)/';
		$regex_contact = '/contact(.*)|kontakt(.*)/i';
		$regex_mail = '/mailto:(.*)/';
		
		$regex_wordpress_shop = '/(\?add-to-cart=[0-9]+|([A-Za-z0-9\-\.\/]+|)\/cart(\/|)[[:>:]]|([A-Za-z0-9\-\.\/]+|)\/basket(\/|)[[:>:]]|([A-Za-z0-9\-\.\/]+|)\/my-basket(\/|)[[:>:]]|([A-Za-z0-9\-\.\/]+|)\/shoppingcart(\/|)[[:>:]])/';	
		
		
		$array_tel = [];
		$array_contact = [];
		$array_mail = [];

		// search your node anywhere in the DOM tree with "//"
		$hyperlink_tel = $xpath->query("//a[php:functionString('preg_match', '$regex_tel', @href)>0]/@href");
		$hyperlink_contact = $xpath->query("//a[php:functionString('preg_match', '$regex_contact', text())>0 or php:functionString('preg_match', '$regex_contact', @href)>0]/@href");
		$hyperlink_mail = $xpath->query("//a[php:functionString('preg_match', '$regex_mail', @href)>0]/@href");
		$hyperlink_wordpress_shop = $xpath->query("//a[php:functionString('preg_match', '$regex_wordpress_shop', @href)>0]/@href");
		
		//sprawdzenie czy wordpress ma koszyk w URL lub sekcja dodania do koszyka
		//?add-to-cart lub /cart/ lub /basket/ lub /my-basket/
		$wp_link = 0;
		$check_is_wordpress_shop = "NO";
		foreach ($hyperlink_wordpress_shop as $element) {
			$wp_link++;
		}
		if ($wp_link > 0) $check_is_wordpress_shop = "YES";
		//test 1 - czy w kodzie 'elementor-menu-cart__toggle_button'
		$test_wp_shop = "/elementor-menu-cart__toggle_button/";
		if(preg_match($test_wp_shop,$out_html)) $check_is_wordpress_shop = "YES";
		//test 2 - czy w kodzie 'wpmenucart-custom-icon'
		$test_wp_shop = "/wpmenucart-custom-icon/";
		if(preg_match($test_wp_shop,$out_html)) $check_is_wordpress_shop = "YES";
		//test 3 - czy w kodzie 'responsiveFlyoutBasket_icon-basket' / 'link-icon--shop'
		$test_wp_shop = "/responsiveFlyoutBasket_icon-basket/";
		if(preg_match($test_wp_shop,$out_html)) $check_is_wordpress_shop = "YES";
		//test 4 - czy w kodzie woocommerce-loop-product__link
		$test_wp_shop = "/woocommerce-loop-product__link/";
		if(preg_match($test_wp_shop,$out_html)) $check_is_wordpress_shop = "YES";
		// test 5 - widget_shopping_cart_content
		$test_wp_shop = "/widget_shopping_cart_content/";
		if(preg_match($test_wp_shop,$out_html)) $check_is_wordpress_shop = "YES";
		//test 6 - wpmenucart-contents
		$test_wp_shop = "/wpmenucart-contents/";
		if(preg_match($test_wp_shop,$out_html)) $check_is_wordpress_shop = "YES";
		//test 7 - add_to_cart_button
		$test_wp_shop = "/add_to_cart_button/";
		if(preg_match($test_wp_shop,$out_html)) $check_is_wordpress_shop = "YES";
		
		//sprawdzenie czy strona na wordpressie
		$check_is_wordpress = "NO";
		$test_wp_1 = "/\/wp-includes\//";
		$test_wp_2 = "/\/wp-content\//";
		if(preg_match($test_wp_1,$out_html) && preg_match($test_wp_2,$out_html)) $check_is_wordpress = "YES";
		
		//Zapisywanie nr tel:
		foreach ($hyperlink_tel as $element) {
			$nodes = $element->childNodes;
			foreach ($nodes as $node) {
				
				$tel_string = str_replace("%20","",$node->nodeValue);
				$tel_string = str_replace("-","",$tel_string);
				$tel_string = str_replace("(","",$tel_string);
				$tel_string = str_replace(")","",$tel_string);
				$tel_string = str_replace(".","",$tel_string);
				$tel_string = str_replace(" ","",$tel_string);
				
				//$scrape_nr_tel = preg_replace('/[^0-9]/', '', $tel_string);
				//array_push($array_tel,['tel'=>$scrape_nr_tel,'site'=>'homepage']);
				
				preg_match_all('/[0-9]+/', $tel_string, $scrape_nr_tel, PREG_SET_ORDER);
				foreach ($scrape_nr_tel as list($scrape_nr_tel_)) {
					if(filtr_number_phone($scrape_nr_tel_) != "") array_push($array_tel,['tel'=>$scrape_nr_tel_,'site'=>'homepage']);
				}

				//echo preg_replace('/[^0-9]/', '', $node->nodeValue). "\n";
				//echo $node->nodeValue."\n";
			}
		}
		//usuwanie duplikatów telefonów
		$array_tel = unique_multidim_array($array_tel,'tel');
		
		
		//Zapisywanie mail
		foreach ($hyperlink_mail as $element) {
			$nodes = $element->childNodes;
			foreach ($nodes as $node) {
				
				$mail_string = strtolower($node->nodeValue); 
				$mail_string = str_replace("mailto:","",$mail_string);
				$mail_string = str_replace("%20","",$mail_string);
				$mail_string = str_replace("%22","",$mail_string);
				$mail_string = str_replace("%C2","",$mail_string);
				$mail_string = str_replace("%A0","",$mail_string);
				$mail_string = str_replace("%80","",$mail_string);
				$mail_string = str_replace("%8B","",$mail_string);
				$mail_string = str_replace("%E2","",$mail_string);
				$mail_string = str_replace("%93","",$mail_string);
				$mail_string = str_replace("%3C","",$mail_string);
				$mail_string = preg_replace("!\s+!"," ",str_replace(array("\n\r", "\n", "\r", PHP_EOL),"",str_replace("|"," ",$mail_string)));
				$temp_string_mail = explode("?",$mail_string);
				$temp_string_mail2 = explode("&",$temp_string_mail[0]);
				$mail_string = $temp_string_mail2[0];
				
				if(preg_match($regex_address_mail,$mail_string) && !preg_match($regex_exclude_mail,$mail_string)) array_push($array_mail,['mail'=>strtolower($mail_string),'site'=>'homepage']);
				
			}
		}
		//usuwanie duplikatów e-mail
		$array_mail = unique_multidim_array($array_mail,'mail');
		
		//URL Kontakt
		foreach ($hyperlink_contact as $element) {
			$nodes = $element->childNodes;
			foreach ($nodes as $node) {
				$scrape_contact = $node->nodeValue;
				if(!preg_match("/(http:|https:)/i",$scrape_contact)) $scrape_contact = $url."/".$scrape_contact; $scrape_contact = str_replace('//', '/', $scrape_contact);
				array_push($array_contact,$scrape_contact);
				//echo preg_replace('/[^0-9]/', '', $node->nodeValue). "\n";
			}
		}
		//usuwanie duplikatów url kontakt
		$array_contact = array_unique($array_contact);
		
		
		for($i=0; $i<count($array_contact); $i++){
			$url_contact = $array_contact[$i];
			//echo $url_contact;
			$ch2 = curl_init();	
			curl_setopt($ch2, CURLOPT_URL, $url_contact);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch2, CURLOPT_HTTPGET, 1);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
			curl_setopt($ch2, CURLOPT_MAXREDIRS, 10);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_LOW_SPEED_LIMIT, 1);   // cancel if below 1 byte/second
			curl_setopt($ch2, CURLOPT_LOW_SPEED_TIME, 60);   // for a period of 30 seconds
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
			$out_html_contact=curl_exec($ch2);
			$out_html_contact = str_replace('&nbsp;',' ',$out_html_contact);

			$new_tel = search_tel($out_html_contact, "contact");
			//var_dump($new_tel);
			//if(count($new_tel[0])>0) array_push($array_tel, $new_tel[0]); $array_tel = unique_multidim_array($array_tel,'tel');
			foreach ($new_tel as $new_tel_number) {
				if(filtr_number_phone($new_tel_number['tel']) != "") array_push($array_tel, $new_tel_number);
			}
			$array_tel = unique_multidim_array($array_tel,'tel');
			
			$new_mail = search_mail($out_html_contact, "contact");
			//if(count($new_mail[0])>0) array_push($array_mail, $new_mail[0]); $array_mail = unique_multidim_array($array_mail,'mail');
			foreach ($new_mail as $new_mail_address) {
				array_push($array_mail,$new_mail_address);
			}
			$array_mail = unique_multidim_array($array_mail,'mail');
			
			curl_close($ch2);
		}

		
		//regex szukanie TEL
		//AUS
		//$regex_number = "/(((\+61)|\(61\))( |)[0-9]( |)[0-9]{4}( |)[0-9]{4}|04[0-9]{2} [0-9]{3} [0-9]{3}|(\+61) [0-9]{3} [0-9]{3} [0-9]{3}|(\+61) [0-9]{3} [0-9]{2} [0-9]{4}|04[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}|((\(|)0(2|3|7|8))(\)|) [0-9]{4} [0-9]{4}|4[0-9]{2}\-[0-9]{3}\-[0-9]{4})|( |\>|\:)04[0-9]{8}( |\<)/";
			
		//UK
		//$regex_number = "/(\+44( |)(0|)[0-9]{10}|(\(|)02[0-9]{1}(\)|) [0-9]{4}( |)[0-9]{4}|(\(|)01[0-9]{2}(\)|) [0-9]{3}( |)[0-9]{4}|(\(|)01[0-9]{3}(\)|) ([0-9]{3}( |)[0-9]{3}|[0-9]{2} [0-9]{2} [0-9]{2})|(\(|)01[0-9]{2} [0-9]{2}(\)|) [0-9]{2}( |)[0-9]{3}|0(3|8|9)[0-9]{2} [0-9]{3}( |)[0-9]{4}|0(5|7)[0-9]{1} ([0-9]{4}|[0-9]{2} [0-9]{2})( |)([0-9]{4}|[0-9]{2} [0-9]{2})|07[0-9]{3} [0-9]{3}( |)[0-9]{3}|(00 |\+)44( |)(\(0\)|)( |)2[0-9]{1} [0-9]{4} [0-9]{4}|\+44( |)(\(0\)|)[0-9]{4} [0-9]{6}|(\(|)\+44(\)|)( |)(\(0\)|)( |)[0-9]{3} [0-9]{3} [0-9]{4}|(00 |\+)44( |)(\(0\)|)( |)[0-9]{4} ([0-9]{6}|[0-9]{3} [0-9]{3}))/";
		
		//US / Kanada
		$regex_number = "/(|(\+|)1 )\([0-9]{3}\)( |)[0-9]{3}(| )-(| )[0-9]{4}|( |\>|\:)((\+|)1-|)[0-9]{3}-[0-9]{3}-[0-9]{4}( |\<)|( |\>|\:)((\+|)1(-|.)|)[0-9]{3}.[0-9]{3}.[0-9]{4}( |\<)/";
		
		//PL
		//$regex_number = "/([\.\> \"\:\(])((\+48( |)|)(\(|)(12|13|14|15|16|17|18|22|23|24|25|26|29|32|33|34|41|42|43|44|46|47|48|52|54|55|56|58|59|61|62|63|65|67|68|71|74|75|76|77|81|82|83|84|85|86|87|89|91|94|95)(\)|) ([0-9]{3} [0-9]{2}( |)[0-9]{2}|[0-9]{2}( |)[0-9]{2} [0-9]{3})|(\+48 |)(45|50|51|53|57|60|66|69|72|73|78|79|88)[0-9]{1} ([0-9]{3} [0-9]{3}|[0-9]{2} [0-9]{2} [0-9]{2})|(\+48( |)|)(45|50|51|53|57|60|66|69|72|73|78|79|88)[0-9]{1}-([0-9]{3}-[0-9]{3}|[0-9]{2}-[0-9]{2}-[0-9]{2})|(12|13|14|15|16|17|18|22|23|24|25|26|29|32|33|34|41|42|43|44|46|47|48|52|54|55|56|58|59|61|62|63|65|67|68|71|74|75|76|77|81|82|83|84|85|86|87|89|91|94|95)(\)|)-([0-9]{3}-[0-9]{2}(-|)[0-9]{2}|[0-9]{2}(-|)[0-9]{2}-[0-9]{3})|(800|801) [0-9]{3} [0-9]{3}|(\+48( |)|)(45|50|51|53|57|60|66|69|72|73|78|79|88)[0-9]{7})([\.\< \"\)])/";
		
		
		if (count($array_tel)<1 && count($array_mail)<1){
			
			
			//$test_html_explode = explode("<body",$out_html);
			//$out_html2 = $test_html_explode[1];
			
			preg_match_all($regex_number, $out_html, $matches_homepage, PREG_SET_ORDER);
			//var_dump($matches_homepage);
			$matches = $matches_homepage;
			
			foreach ($matches as $match) {
				//preg_match_all('/[0-9]+/', $match[0], $nr_tel_only_digit, PREG_SET_ORDER);
				//if($match[0]!= NULL) array_push($array_tel,['tel'=>$nr_tel_only_digit[0][0],'site'=>'homepage_regex']); $array_tel = unique_multidim_array($array_tel,'tel');
				
				$tel_finish_result = str_replace(">","",$match[0]);
				$tel_finish_result = str_replace("<","",$tel_finish_result);
				//if($match[0]!= NULL) array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'homepage_regex']); 
				if($match[0]!= NULL && filtr_number_phone($tel_finish_result) != "") array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'homepage_regex']); 
				
				
				//if($match[0]!= NULL) array_push($array_tel,['tel'=>$match[0],'site'=>'homepage_regex']); $array_tel = unique_multidim_array($array_tel,'tel');
			}
			$array_tel = unique_multidim_array($array_tel,'tel');
			
			//szukanie regex mail
			preg_match_all($regex_address_mail, strtolower($out_html), $matches_mail_homepage, PREG_SET_ORDER);
			$matches_mail = $matches_mail_homepage;
			foreach ($matches_mail as $match_mail) {
				if($match_mail[0]!= NULL && !preg_match($regex_exclude_mail,$match_mail[0])) array_push($array_mail,['mail'=>strtolower($match_mail[0]),'site'=>'homepage_regex']); 
			}
			$array_mail = unique_multidim_array($array_mail,'mail');
			
			
			for($i=0; $i<count($array_contact); $i++){
				$url_contact = $array_contact[$i];
				$ch2 = curl_init();	
				curl_setopt($ch2, CURLOPT_URL, $url_contact);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($ch2, CURLOPT_HTTPGET, 1);
				curl_setopt($ch2, CURLOPT_HEADER, 0);
				curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
				curl_setopt($ch2, CURLOPT_MAXREDIRS, 10);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_LOW_SPEED_LIMIT, 1);   // cancel if below 1 byte/second
				curl_setopt($ch2, CURLOPT_LOW_SPEED_TIME, 60);   // for a period of 30 seconds
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
				$out_html_contact=curl_exec($ch2);
				$out_html_contact = str_replace('&nbsp;',' ',$out_html_contact);
				
				//$test_html_explode = explode("<body",$out_html_contact);
				//$out_html_contact2 = $test_html_explode[1];
				
				preg_match_all($regex_number, $out_html_contact, $matches_contact, PREG_SET_ORDER);
				//var_dump($matches_contact);
				$matches = $matches_contact;
				foreach ($matches as $match) {
					//usuniecie > <
					$tel_finish_result = str_replace(">","",$match[0]);
					$tel_finish_result = str_replace("<","",$tel_finish_result);
					//if($match[0]!= NULL) array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'contact_regex']); 
					if($match[0]!= NULL && filtr_number_phone($tel_finish_result) != "") array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'contact_regex']);

				}
				$array_tel = unique_multidim_array($array_tel,'tel');
				
				//szukanie regex mail
				preg_match_all($regex_address_mail, strtolower($out_html_contact), $matches_mail_contact, PREG_SET_ORDER);
				$matches_mail = $matches_mail_contact;
				foreach ($matches_mail as $match_mail) {
					if($match_mail[0]!= NULL && !preg_match($regex_exclude_mail,$match_mail[0])) array_push($array_mail,['mail'=>strtolower($match_mail[0]),'site'=>'contact_regex']); 
				}
				$array_mail = unique_multidim_array($array_mail,'mail');
				
				curl_close($ch2);
			}

		}
		elseif (count($array_tel)<1 && count($array_mail)>0){
			
			
			//$test_html_explode = explode("<body",$out_html);
			//$out_html2 = $test_html_explode[1];
			
			preg_match_all($regex_number, $out_html, $matches_homepage, PREG_SET_ORDER);
			//var_dump($matches_homepage);
			$matches = $matches_homepage;
			
			foreach ($matches as $match) {
				//preg_match_all('/[0-9]+/', $match[0], $nr_tel_only_digit, PREG_SET_ORDER);
				//if($match[0]!= NULL) array_push($array_tel,['tel'=>$nr_tel_only_digit[0][0],'site'=>'homepage_regex']); $array_tel = unique_multidim_array($array_tel,'tel');
				
				$tel_finish_result = str_replace(">","",$match[0]);
				$tel_finish_result = str_replace("<","",$tel_finish_result);
				//if($match[0]!= NULL) array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'homepage_regex']); 
				if($match[0]!= NULL && filtr_number_phone($tel_finish_result) != "") array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'homepage_regex']);
				
				//if($match[0]!= NULL) array_push($array_tel,['tel'=>$match[0],'site'=>'homepage_regex']); $array_tel = unique_multidim_array($array_tel,'tel');
			}
			$array_tel = unique_multidim_array($array_tel,'tel');
			
			//szukanie regex mail
			/*
			preg_match_all($regex_address_mail, $out_html, $matches_mail_homepage, PREG_SET_ORDER);
			$matches_mail = $matches_mail_homepage;
			foreach ($matches_mail as $match_mail) {
				if($match_mail[0]!= NULL && !preg_match($regex_exclude_mail,$match_mail[0])) array_push($array_mail,['mail'=>$match_mail[0],'site'=>'homepage_regex']); 
			}
			$array_mail = unique_multidim_array($array_mail,'mail');
			*/
			
			for($i=0; $i<count($array_contact); $i++){
				$url_contact = $array_contact[$i];
				$ch2 = curl_init();	
				curl_setopt($ch2, CURLOPT_URL, $url_contact);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($ch2, CURLOPT_HTTPGET, 1);
				curl_setopt($ch2, CURLOPT_HEADER, 0);
				curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
				curl_setopt($ch2, CURLOPT_MAXREDIRS, 10);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_LOW_SPEED_LIMIT, 1);   // cancel if below 1 byte/second
				curl_setopt($ch2, CURLOPT_LOW_SPEED_TIME, 60);   // for a period of 30 seconds
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
				$out_html_contact=curl_exec($ch2);
				$out_html_contact = str_replace('&nbsp;',' ',$out_html_contact);
				
				//$test_html_explode = explode("<body",$out_html_contact);
				//$out_html_contact2 = $test_html_explode[1];
				
				preg_match_all($regex_number, $out_html_contact, $matches_contact, PREG_SET_ORDER);
				//var_dump($matches_contact);
				$matches = $matches_contact;
				foreach ($matches as $match) {
					//usuniecie > <
					$tel_finish_result = str_replace(">","",$match[0]);
					$tel_finish_result = str_replace("<","",$tel_finish_result);
					//if($match[0]!= NULL) array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'contact_regex']); 
					if($match[0]!= NULL && filtr_number_phone($tel_finish_result) != "") array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'contact_regex']);
				}
				$array_tel = unique_multidim_array($array_tel,'tel');
				
				//szukanie regex mail
				/*
				preg_match_all($regex_address_mail, $out_html_contact, $matches_mail_contact, PREG_SET_ORDER);
				$matches_mail = $matches_mail_contact;
				foreach ($matches_mail as $match_mail) {
					if($match_mail[0]!= NULL && !preg_match($regex_exclude_mail,$match_mail[0])) array_push($array_mail,['mail'=>$match_mail[0],'site'=>'contact_regex']); 
				}
				$array_mail = unique_multidim_array($array_mail,'mail');
				*/
				
				curl_close($ch2);
			}

		}
		elseif (count($array_tel)>0 && count($array_mail)<1){
			
			
			//$test_html_explode = explode("<body",$out_html);
			//$out_html2 = $test_html_explode[1];
			/*
			preg_match_all($regex_number, $out_html, $matches_homepage, PREG_SET_ORDER);
			//var_dump($matches_homepage);
			$matches = $matches_homepage;
			
			foreach ($matches as $match) {
				//preg_match_all('/[0-9]+/', $match[0], $nr_tel_only_digit, PREG_SET_ORDER);
				//if($match[0]!= NULL) array_push($array_tel,['tel'=>$nr_tel_only_digit[0][0],'site'=>'homepage_regex']); $array_tel = unique_multidim_array($array_tel,'tel');
				
				$tel_finish_result = str_replace(">","",$match[0]);
				$tel_finish_result = str_replace("<","",$tel_finish_result);
				if($match[0]!= NULL) array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'homepage_regex']); 
				
				//if($match[0]!= NULL) array_push($array_tel,['tel'=>$match[0],'site'=>'homepage_regex']); $array_tel = unique_multidim_array($array_tel,'tel');
			}
			$array_tel = unique_multidim_array($array_tel,'tel');
			*/
			
			//szukanie regex mail
			preg_match_all($regex_address_mail, strtolower($out_html), $matches_mail_homepage, PREG_SET_ORDER);
			$matches_mail = $matches_mail_homepage;
			foreach ($matches_mail as $match_mail) {
				if($match_mail[0]!= NULL && !preg_match($regex_exclude_mail,$match_mail[0])) array_push($array_mail,['mail'=>strtolower($match_mail[0]),'site'=>'homepage_regex']); 
			}
			$array_mail = unique_multidim_array($array_mail,'mail');
			
			
			for($i=0; $i<count($array_contact); $i++){
				$url_contact = $array_contact[$i];
				$ch2 = curl_init();	
				curl_setopt($ch2, CURLOPT_URL, $url_contact);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($ch2, CURLOPT_HTTPGET, 1);
				curl_setopt($ch2, CURLOPT_HEADER, 0);
				curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
				curl_setopt($ch2, CURLOPT_MAXREDIRS, 10);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_LOW_SPEED_LIMIT, 1);   // cancel if below 1 byte/second
				curl_setopt($ch2, CURLOPT_LOW_SPEED_TIME, 60);   // for a period of 30 seconds
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
				$out_html_contact=curl_exec($ch2);
				$out_html_contact = str_replace('&nbsp;',' ',$out_html_contact);
				
				//$test_html_explode = explode("<body",$out_html_contact);
				//$out_html_contact2 = $test_html_explode[1];
				/*
				preg_match_all($regex_number, $out_html_contact, $matches_contact, PREG_SET_ORDER);
				//var_dump($matches_contact);
				$matches = $matches_contact;
				foreach ($matches as $match) {
					//usuniecie > <
					$tel_finish_result = str_replace(">","",$match[0]);
					$tel_finish_result = str_replace("<","",$tel_finish_result);
					if($match[0]!= NULL) array_push($array_tel,['tel'=>$tel_finish_result,'site'=>'contact_regex']); 
				}
				$array_tel = unique_multidim_array($array_tel,'tel');
				*/
				
				//szukanie regex mail
				preg_match_all($regex_address_mail, strtolower($out_html_contact), $matches_mail_contact, PREG_SET_ORDER);
				$matches_mail = $matches_mail_contact;
				foreach ($matches_mail as $match_mail) {
					if($match_mail[0]!= NULL && !preg_match($regex_exclude_mail,$match_mail[0])) array_push($array_mail,['mail'=>strtolower($match_mail[0]),'site'=>'contact_regex']); 
				}
				$array_mail = unique_multidim_array($array_mail,'mail');
				
				curl_close($ch2);
			}

		}
		else{}
		
		
		
		

		//echo "<td>".count($array_tel)."</td>";
		//echo "<td>".count($array_contact)."</td>";
		
		//jeden format numeru telefonu
		for($i=0; $i<count($array_tel); $i++){
			$array_tel[$i]['tel'] = filtr_number_phone($array_tel[$i]['tel']);
		}
		$array_tel = unique_multidim_array($array_tel,'tel');
		//
		
		//$info_wp_shop = "";
		//dodanie info o title i meta desc
		$info_meta = "|".$meta_title."|".$meta_desc;
		$info_wp_shop = "|";
		if ($check_is_wordpress_shop == "YES") $info_wp_shop = "|WP-SHOP";
		
		//if ($check_is_wordpress == "YES") {$info_wp_shop .= "|CMS_WP";} else{$info_wp_shop .= "|";}
		
		$nr_to_low = 0;
		$nr_tel = "";
		for($i=0; $i<count($array_tel); $i++){
			$nr_tel .= $array_tel[$i]['tel']."</br>";
			//export do pliku tylko pierwszych 5 numerów tel
			if ($i<5)
			{
				$data1 =  $url_file_txt."|".$array_tel[$i]['tel'].$info_meta.$info_wp_shop.PHP_EOL;
				//gdy dlugosc nr mniejsza niz 5 znaki to nie zapisuj
				if(strlen($array_tel[$i]['tel'])<5){$nr_to_low++;}
				else{fwrite($file_result, $data1);}
			}
			else{}
		}
		if((count($array_tel)-$nr_to_low)<1) fwrite($file_again_to_scrapers, $url.$info_wp_shop.PHP_EOL);

		$nr_tel_info = "";
		for($i=0; $i<count($array_tel); $i++){
			$nr_tel_info .= $array_tel[$i]['tel']." - ".$array_tel[$i]['site']."</br>";
		}
		
		$address_mail = "";
		for($i=0; $i<count($array_mail); $i++){
			$address_mail .= $array_mail[$i]['mail']."</br>";
			//export do pliku tylko pierwszych 5 mailow
			if ($i<5)
			{
				$data1_mail =  $url_file_txt."|".$array_mail[$i]['mail'].$info_wp_shop.PHP_EOL;
				if((strlen($array_mail[$i]['mail']))>5) fwrite($file_mail_result, $data1_mail);
			}
			else{}
		}
		
		$address_mail_info = "";
		for($i=0; $i<count($array_mail); $i++){
			$address_mail_info .= $array_mail[$i]['mail']." - ".$array_mail[$i]['site']."</br>";
		}
		
		$podstrona_kontakt = "";
		for($i=0; $i<count($array_contact); $i++){
			$podstrona_kontakt .= $array_contact[$i]."</br>";
		}

		
		
		///////---HTTP != 200
		}
		else{
			fwrite($file_domain_down, $url.PHP_EOL);
			$url_domain = $url;
			$http_code = $httpcode;
			$url_docelowe = $last_url;
			$nr_tel = "";
			$nr_tel_info = "";
			$address_mail = "";
			$address_mail_info = "";
			$podstrona_kontakt = "";
			$check_is_wordpress_shop = "";
		}

	$data_time = $url."|".date("Y-m-d H:i:s").PHP_EOL;
	fwrite($file_time_check, $data_time);
	////////
	curl_close($ch);
	

print_r(json_encode(array(
  'url' => $url_domain,
  'http_code' => $http_code,
  'url_docelowe' => $url_docelowe,
  'nr_tel' => $nr_tel,
  'nr_tel_info' => $nr_tel_info,
  'mail' => $address_mail,
  'mail_info' => $address_mail_info,
  'podstrona_kontakt' => $podstrona_kontakt,
  'wp_shop' => $check_is_wordpress_shop,
  'error' => isset($error) ? $error : false
)));

?>	
 