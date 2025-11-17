<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php //error_reporting(E_ALL | E_STRICT);//デバッグ
###############################################################################################
##
#  PHPダウンロードカウンター
#　改造や改変は自己責任で行ってください。
#	
#  今のところ特に問題点はありませんが、不具合等がありましたら下記までご連絡ください。
#  MailAddress: info@php-factory.net
#  name: K.Numata
#  HP: http://www.php-factory.net/
##
###############################################################################################

if(isset($_GET)) $_GET = sanitize($_GET);//NULLバイト除去//
if(isset($_POST)) $_POST = sanitize($_POST);//NULLバイト除去//
if(isset($_COOKIE)) $_COOKIE = sanitize($_COOKIE);//NULLバイト除去//


/*=============================================================================================================

ダウンロードファイルの絶対パス（http～）※相対パス不可。URLは必ずhttp～から始まるURLを指定して下さい。
追加する場合は、1行をそのままコピペでその下に追加し、「'1' =>」の数字部分を必ず変更して下さい。
特に理由が無ければ連番（1,2,3...）にしてください。

複数の場合の記述例

$download_url = array(
'1' => 'http://www.php-factory.net/demo/download_count/test1.pdf',
'2' => 'http://www.php-factory.net/demo/download_count/test2.pdf',
'3' => 'http://www.php-factory.net/demo/download_count/test3.pdf',
'4' => 'http://www.php-factory.net/demo/download_count/test4.pdf',
);


左側の数字がそのままダウンロード用のパラメータになります。
パラメータがdownload=1で「'1' =>」のURL、download=3で「'3' =>」のURLのファイルがダウンロードされます。
例　あなたのサイトURL/download_count/download.php?download=1　で「'1' => 」のURLのファイルがダウンロードになります。

ダウンロードリンクごとにログファイルが生成されます。
リストから削除すれば該当するログファイルも削除されます。
※削除のタイミングはいずれかのダウンロードリンクをクリックした際に削除処理されます。


=============================================================================================================*/

//-----------------------------　設定箇所（START）　-------------------------------
//ダウンロードファイルの絶対パス（http～）記述
$download_url = array(
'1' => 'https://nanyo-city.jpn.org/prompt/001.html',
'2' => 'https://nanyo-city.jpn.org/prompt/002.html',
'3' => 'https://nanyo-city.jpn.org/prompt/003.html',
'4' => 'https://nanyo-city.jpn.org/prompt/004.html',
'5' => 'https://nanyo-city.jpn.org/prompt/005.html',
'6' => 'https://nanyo-city.jpn.org/prompt/006.html',
'7' => 'https://nanyo-city.jpn.org/prompt/007.html',
'8' => 'https://nanyo-city.jpn.org/prompt/008.html',
'9' => 'https://nanyo-city.jpn.org/prompt/009.html',
'10' => 'https://nanyo-city.jpn.org/prompt/010.html',
'11' => 'https://nanyo-city.jpn.org/prompt/011.html',
'12' => 'https://nanyo-city.jpn.org/prompt/012.html',
'13' => 'https://nanyo-city.jpn.org/prompt/013.html',
'14' => 'https://nanyo-city.jpn.org/prompt/014.html',
'15' => 'https://nanyo-city.jpn.org/prompt/015.html',
'16' => 'https://nanyo-city.jpn.org/prompt/016.html',
'17' => 'https://nanyo-city.jpn.org/prompt/017.html',
'18' => 'https://nanyo-city.jpn.org/prompt/018.html',
'19' => 'https://nanyo-city.jpn.org/prompt/019.html',
'20' => 'https://nanyo-city.jpn.org/prompt/020.html',
'21' => 'https://nanyo-city.jpn.org/prompt/021.html',
'22' => 'https://nanyo-city.jpn.org/prompt/022.html',
'23' => 'https://nanyo-city.jpn.org/prompt/023.html',
'24' => 'https://nanyo-city.jpn.org/prompt/024.html',
'25' => 'https://nanyo-city.jpn.org/prompt/025.html',
'26' => 'https://nanyo-city.jpn.org/prompt/026.html',
'27' => 'https://nanyo-city.jpn.org/prompt/027.html',
'28' => 'https://nanyo-city.jpn.org/prompt/028.html',
'29' => 'https://nanyo-city.jpn.org/prompt/029.html',
'30' => 'https://nanyo-city.jpn.org/prompt/030.html',
'31' => 'https://nanyo-city.jpn.org/prompt/031.html',
'32' => 'https://nanyo-city.jpn.org/prompt/032.html',
'33' => 'https://nanyo-city.jpn.org/prompt/033.html',
'34' => 'https://nanyo-city.jpn.org/prompt/034.html',
'35' => 'https://nanyo-city.jpn.org/prompt/035.html',
'36' => 'https://nanyo-city.jpn.org/prompt/036.html',
'37' => 'https://nanyo-city.jpn.org/prompt/037.html',
'38' => 'https://nanyo-city.jpn.org/prompt/038.html',
'39' => 'https://nanyo-city.jpn.org/prompt/039.html',
'40' => 'https://nanyo-city.jpn.org/prompt/040.html',
'41' => 'https://nanyo-city.jpn.org/prompt/041.html',
'42' => 'https://nanyo-city.jpn.org/prompt/042.html',
'43' => 'https://nanyo-city.jpn.org/prompt/043.html',
'44' => 'https://nanyo-city.jpn.org/prompt/044.html',
'45' => 'https://nanyo-city.jpn.org/prompt/045.html',
'46' => 'https://nanyo-city.jpn.org/prompt/046.html',
'47' => 'https://nanyo-city.jpn.org/prompt/047.html',
'48' => 'https://nanyo-city.jpn.org/prompt/048.html',
'49' => 'https://nanyo-city.jpn.org/prompt/049.html',
'50' => 'https://nanyo-city.jpn.org/prompt/050.html',
'51' => 'https://nanyo-city.jpn.org/prompt/051.html',
'52' => 'https://nanyo-city.jpn.org/prompt/052.html',
'53' => 'https://nanyo-city.jpn.org/prompt/053.html',
'54' => 'https://nanyo-city.jpn.org/prompt/054.html',
'55' => 'https://nanyo-city.jpn.org/prompt/055.html',
'56' => 'https://nanyo-city.jpn.org/prompt/056.html',
'57' => 'https://nanyo-city.jpn.org/prompt/057.html',
'58' => 'https://nanyo-city.jpn.org/prompt/058.html',
'59' => 'https://nanyo-city.jpn.org/prompt/059.html',
'60' => 'https://nanyo-city.jpn.org/prompt/060.html',
'61' => 'https://nanyo-city.jpn.org/prompt/061.html',
'62' => 'https://nanyo-city.jpn.org/prompt/062.html',
'63' => 'https://nanyo-city.jpn.org/prompt/063.html',
'64' => 'https://nanyo-city.jpn.org/prompt/064.html',
'65' => 'https://nanyo-city.jpn.org/prompt/065.html',
'66' => 'https://nanyo-city.jpn.org/prompt/066.html',
'67' => 'https://nanyo-city.jpn.org/prompt/067.html',
'68' => 'https://nanyo-city.jpn.org/prompt/068.html',
'69' => 'https://nanyo-city.jpn.org/prompt/069.html',
'70' => 'https://nanyo-city.jpn.org/prompt/070.html',
'71' => 'https://nanyo-city.jpn.org/prompt/071.html',
'72' => 'https://nanyo-city.jpn.org/prompt/072.html',
'73' => 'https://nanyo-city.jpn.org/prompt/073.html',
'74' => 'https://nanyo-city.jpn.org/prompt/074.html',
'75' => 'https://nanyo-city.jpn.org/prompt/075.html',
'76' => 'https://nanyo-city.jpn.org/prompt/076.html',
'77' => 'https://nanyo-city.jpn.org/prompt/077.html',
'78' => 'https://nanyo-city.jpn.org/prompt/078.html',
'79' => 'https://nanyo-city.jpn.org/prompt/079.html',
'80' => 'https://nanyo-city.jpn.org/prompt/080.html',
'81' => 'https://nanyo-city.jpn.org/prompt/081.html',
'82' => 'https://nanyo-city.jpn.org/prompt/082.html',
'83' => 'https://nanyo-city.jpn.org/prompt/083.html',
'84' => 'https://nanyo-city.jpn.org/prompt/084.html',
'85' => 'https://nanyo-city.jpn.org/prompt/085.html',
'86' => 'https://nanyo-city.jpn.org/prompt/086.html',
'87' => 'https://nanyo-city.jpn.org/prompt/087.html',
'88' => 'https://nanyo-city.jpn.org/prompt/088.html',
'89' => 'https://nanyo-city.jpn.org/prompt/089.html',
'90' => 'https://nanyo-city.jpn.org/prompt/090.html',
'91' => 'https://nanyo-city.jpn.org/prompt/091.html',
'92' => 'https://nanyo-city.jpn.org/prompt/092.html',
'93' => 'https://nanyo-city.jpn.org/prompt/093.html',
'94' => 'https://nanyo-city.jpn.org/prompt/094.html',
'95' => 'https://nanyo-city.jpn.org/prompt/095.html',
'96' => 'https://nanyo-city.jpn.org/prompt/096.html',
'97' => 'https://nanyo-city.jpn.org/prompt/097.html',
'98' => 'https://nanyo-city.jpn.org/prompt/098.html',
'99' => 'https://nanyo-city.jpn.org/prompt/099.html',
'100' => 'https://nanyo-city.jpn.org/prompt/100.html',
'101' => 'https://nanyo-city.jpn.org/prompt/101.html',
'102' => 'https://nanyo-city.jpn.org/prompt/102.html',
'103' => 'https://nanyo-city.jpn.org/prompt/103.html',
'104' => 'https://nanyo-city.jpn.org/prompt/104.html',
'105' => 'https://nanyo-city.jpn.org/prompt/105.html',
'106' => 'https://nanyo-city.jpn.org/prompt/106.html',
'107' => 'https://nanyo-city.jpn.org/prompt/107.html',
'108' => 'https://nanyo-city.jpn.org/prompt/108.html',
'109' => 'https://nanyo-city.jpn.org/prompt/109.html',
'110' => 'https://nanyo-city.jpn.org/prompt/110.html',
'111' => 'https://nanyo-city.jpn.org/prompt/111.html',
'112' => 'https://nanyo-city.jpn.org/prompt/112.html',
'113' => 'https://nanyo-city.jpn.org/prompt/113.html',
'114' => 'https://nanyo-city.jpn.org/prompt/114.html',
'115' => 'https://nanyo-city.jpn.org/prompt/115.html',
'116' => 'https://nanyo-city.jpn.org/prompt/116.html',
'117' => 'https://nanyo-city.jpn.org/prompt/117.html',
'118' => 'https://nanyo-city.jpn.org/prompt/118.html',
'119' => 'https://nanyo-city.jpn.org/prompt/119.html',
'120' => 'https://nanyo-city.jpn.org/prompt/120.html',
'121' => 'https://nanyo-city.jpn.org/prompt/121.html',
'122' => 'https://nanyo-city.jpn.org/prompt/122.html',
'123' => 'https://nanyo-city.jpn.org/prompt/123.html',
'124' => 'https://nanyo-city.jpn.org/prompt/124.html',
'125' => 'https://nanyo-city.jpn.org/prompt/125.html',
'126' => 'https://nanyo-city.jpn.org/prompt/126.html',
'127' => 'https://nanyo-city.jpn.org/prompt/127.html',
'128' => 'https://nanyo-city.jpn.org/prompt/128.html',
'129' => 'https://nanyo-city.jpn.org/prompt/129.html',
'130' => 'https://nanyo-city.jpn.org/prompt/130.html',
'131' => 'https://nanyo-city.jpn.org/prompt/131.html',
'132' => 'https://nanyo-city.jpn.org/prompt/132.html',
'133' => 'https://nanyo-city.jpn.org/prompt/133.html',
'134' => 'https://nanyo-city.jpn.org/prompt/134.html',
'135' => 'https://nanyo-city.jpn.org/prompt/135.html',
'136' => 'https://nanyo-city.jpn.org/prompt/136.html',
'137' => 'https://nanyo-city.jpn.org/prompt/137.html',
'138' => 'https://nanyo-city.jpn.org/prompt/138.html',
'139' => 'https://nanyo-city.jpn.org/prompt/139.html',
'140' => 'https://nanyo-city.jpn.org/prompt/140.html',
'141' => 'https://nanyo-city.jpn.org/prompt/141.html',
'142' => 'https://nanyo-city.jpn.org/prompt/142.html',
'143' => 'https://nanyo-city.jpn.org/prompt/143.html',
'144' => 'https://nanyo-city.jpn.org/prompt/144.html',
'145' => 'https://nanyo-city.jpn.org/prompt/145.html',
'146' => 'https://nanyo-city.jpn.org/prompt/146.html',
'147' => 'https://nanyo-city.jpn.org/prompt/147.html',
'148' => 'https://nanyo-city.jpn.org/prompt/148.html',
'149' => 'https://nanyo-city.jpn.org/prompt/149.html',
'150' => 'https://nanyo-city.jpn.org/prompt/150.html',
'151' => 'https://nanyo-city.jpn.org/prompt/151.html',
'152' => 'https://nanyo-city.jpn.org/prompt/152.html',
'153' => 'https://nanyo-city.jpn.org/prompt/153.html',
'154' => 'https://nanyo-city.jpn.org/prompt/154.html',
'155' => 'https://nanyo-city.jpn.org/prompt/155.html',
'156' => 'https://nanyo-city.jpn.org/prompt/156.html',
'157' => 'https://nanyo-city.jpn.org/prompt/157.html',
'158' => 'https://nanyo-city.jpn.org/prompt/158.html',
'159' => 'https://nanyo-city.jpn.org/prompt/159.html',
'160' => 'https://nanyo-city.jpn.org/prompt/160.html',
'161' => 'https://nanyo-city.jpn.org/prompt/161.html',
'162' => 'https://nanyo-city.jpn.org/prompt/162.html',
'163' => 'https://nanyo-city.jpn.org/prompt/163.html',
'164' => 'https://nanyo-city.jpn.org/prompt/164.html',
'165' => 'https://nanyo-city.jpn.org/prompt/165.html',
'166' => 'https://nanyo-city.jpn.org/prompt/166.html',
'167' => 'https://nanyo-city.jpn.org/prompt/167.html',
'168' => 'https://nanyo-city.jpn.org/prompt/168.html',
'169' => 'https://nanyo-city.jpn.org/prompt/169.html',
'170' => 'https://nanyo-city.jpn.org/prompt/170.html',
'171' => 'https://nanyo-city.jpn.org/prompt/171.html',
'172' => 'https://nanyo-city.jpn.org/prompt/172.html',
'173' => 'https://nanyo-city.jpn.org/prompt/173.html',
'174' => 'https://nanyo-city.jpn.org/prompt/174.html',
'175' => 'https://nanyo-city.jpn.org/prompt/175.html',
'176' => 'https://nanyo-city.jpn.org/prompt/176.html',
'177' => 'https://nanyo-city.jpn.org/prompt/177.html',
'178' => 'https://nanyo-city.jpn.org/prompt/178.html',
'179' => 'https://nanyo-city.jpn.org/prompt/179.html',
'180' => 'https://nanyo-city.jpn.org/prompt/180.html',
'181' => 'https://nanyo-city.jpn.org/prompt/181.html',
'182' => 'https://nanyo-city.jpn.org/prompt/182.html',
'183' => 'https://nanyo-city.jpn.org/prompt/183.html',
'184' => 'https://nanyo-city.jpn.org/prompt/184.html',
'185' => 'https://nanyo-city.jpn.org/prompt/185.html',
'186' => 'https://nanyo-city.jpn.org/prompt/186.html',
'187' => 'https://nanyo-city.jpn.org/prompt/187.html',
'188' => 'https://nanyo-city.jpn.org/prompt/188.html',
'189' => 'https://nanyo-city.jpn.org/prompt/189.html',
'190' => 'https://nanyo-city.jpn.org/prompt/190.html',
'191' => 'https://nanyo-city.jpn.org/prompt/191.html',
'192' => 'https://nanyo-city.jpn.org/prompt/192.html',
'193' => 'https://nanyo-city.jpn.org/prompt/193.html',
'194' => 'https://nanyo-city.jpn.org/prompt/194.html',
'195' => 'https://nanyo-city.jpn.org/prompt/195.html',
'196' => 'https://nanyo-city.jpn.org/prompt/196.html',
'197' => 'https://nanyo-city.jpn.org/prompt/197.html',
'198' => 'https://nanyo-city.jpn.org/prompt/198.html',
'199' => 'https://nanyo-city.jpn.org/prompt/199.html',
'200' => 'https://nanyo-city.jpn.org/prompt/200.html',
'201' => 'https://nanyo-city.jpn.org/prompt/201.html',
'202' => 'https://nanyo-city.jpn.org/prompt/202.html',
'203' => 'https://nanyo-city.jpn.org/prompt/203.html',
'204' => 'https://nanyo-city.jpn.org/prompt/204.html',
'205' => 'https://nanyo-city.jpn.org/prompt/205.html',
'206' => 'https://nanyo-city.jpn.org/prompt/206.html',
'207' => 'https://nanyo-city.jpn.org/prompt/207.html',
'208' => 'https://nanyo-city.jpn.org/prompt/208.html',
'209' => 'https://nanyo-city.jpn.org/prompt/209.html',
'210' => 'https://nanyo-city.jpn.org/prompt/210.html',
'211' => 'https://nanyo-city.jpn.org/prompt/211.html',
'212' => 'https://nanyo-city.jpn.org/prompt/212.html',
'213' => 'https://nanyo-city.jpn.org/prompt/213.html',
'214' => 'https://nanyo-city.jpn.org/prompt/214.html',
'215' => 'https://nanyo-city.jpn.org/prompt/215.html',
'216' => 'https://nanyo-city.jpn.org/prompt/216.html',
'217' => 'https://nanyo-city.jpn.org/prompt/217.html',
'218' => 'https://nanyo-city.jpn.org/prompt/218.html',
'219' => 'https://nanyo-city.jpn.org/prompt/219.html',
'220' => 'https://nanyo-city.jpn.org/prompt/220.html',
'221' => 'https://nanyo-city.jpn.org/prompt/221.html',
'222' => 'https://nanyo-city.jpn.org/prompt/222.html',
'223' => 'https://nanyo-city.jpn.org/prompt/223.html',
'224' => 'https://nanyo-city.jpn.org/prompt/224.html',
'225' => 'https://nanyo-city.jpn.org/prompt/225.html',
'226' => 'https://nanyo-city.jpn.org/prompt/226.html',
'227' => 'https://nanyo-city.jpn.org/prompt/227.html',
'228' => 'https://nanyo-city.jpn.org/prompt/228.html',
'229' => 'https://nanyo-city.jpn.org/prompt/229.html',
'230' => 'https://nanyo-city.jpn.org/prompt/230.html',
'231' => 'https://nanyo-city.jpn.org/prompt/231.html',
'232' => 'https://nanyo-city.jpn.org/prompt/232.html',
'233' => 'https://nanyo-city.jpn.org/prompt/233.html',
'234' => 'https://nanyo-city.jpn.org/prompt/234.html',
'235' => 'https://nanyo-city.jpn.org/prompt/235.html',
'236' => 'https://nanyo-city.jpn.org/prompt/236.html',
'237' => 'https://nanyo-city.jpn.org/prompt/237.html',
'238' => 'https://nanyo-city.jpn.org/prompt/238.html',
'239' => 'https://nanyo-city.jpn.org/prompt/239.html',
'240' => 'https://nanyo-city.jpn.org/prompt/240.html',
'241' => 'https://nanyo-city.jpn.org/prompt/241.html',
'242' => 'https://nanyo-city.jpn.org/prompt/242.html',
'243' => 'https://nanyo-city.jpn.org/prompt/243.html',
'244' => 'https://nanyo-city.jpn.org/prompt/244.html',
'245' => 'https://nanyo-city.jpn.org/prompt/245.html',
'246' => 'https://nanyo-city.jpn.org/prompt/246.html',
'247' => 'https://nanyo-city.jpn.org/prompt/247.html',
'248' => 'https://nanyo-city.jpn.org/prompt/248.html',
'249' => 'https://nanyo-city.jpn.org/prompt/249.html',
'250' => 'https://nanyo-city.jpn.org/prompt/250.html',
'251' => 'https://nanyo-city.jpn.org/prompt/251.html',
'252' => 'https://nanyo-city.jpn.org/prompt/252.html',
'253' => 'https://nanyo-city.jpn.org/prompt/253.html',
'254' => 'https://nanyo-city.jpn.org/prompt/254.html',
'255' => 'https://nanyo-city.jpn.org/prompt/255.html',
'256' => 'https://nanyo-city.jpn.org/prompt/256.html',
'257' => 'https://nanyo-city.jpn.org/prompt/257.html',
'258' => 'https://nanyo-city.jpn.org/prompt/258.html',
'259' => 'https://nanyo-city.jpn.org/prompt/259.html',
'260' => 'https://nanyo-city.jpn.org/prompt/260.html',
'261' => 'https://nanyo-city.jpn.org/prompt/261.html',
'262' => 'https://nanyo-city.jpn.org/prompt/262.html',
'263' => 'https://nanyo-city.jpn.org/prompt/263.html',
'264' => 'https://nanyo-city.jpn.org/prompt/264.html',
'265' => 'https://nanyo-city.jpn.org/prompt/265.html',
'266' => 'https://nanyo-city.jpn.org/prompt/266.html',
'267' => 'https://nanyo-city.jpn.org/prompt/267.html',
'268' => 'https://nanyo-city.jpn.org/prompt/268.html',
'269' => 'https://nanyo-city.jpn.org/prompt/269.html',
'270' => 'https://nanyo-city.jpn.org/prompt/270.html',
'271' => 'https://nanyo-city.jpn.org/prompt/271.html',
'272' => 'https://nanyo-city.jpn.org/prompt/272.html',
'273' => 'https://nanyo-city.jpn.org/prompt/273.html',
'274' => 'https://nanyo-city.jpn.org/prompt/274.html',
'275' => 'https://nanyo-city.jpn.org/prompt/275.html',
'276' => 'https://nanyo-city.jpn.org/prompt/276.html',
'277' => 'https://nanyo-city.jpn.org/prompt/277.html',
'278' => 'https://nanyo-city.jpn.org/prompt/278.html',
'279' => 'https://nanyo-city.jpn.org/prompt/279.html',
'280' => 'https://nanyo-city.jpn.org/prompt/280.html',
'281' => 'https://nanyo-city.jpn.org/prompt/281.html',
'282' => 'https://nanyo-city.jpn.org/prompt/282.html',
'283' => 'https://nanyo-city.jpn.org/prompt/283.html',
'284' => 'https://nanyo-city.jpn.org/prompt/284.html',
'285' => 'https://nanyo-city.jpn.org/prompt/285.html',
'286' => 'https://nanyo-city.jpn.org/prompt/286.html',
'287' => 'https://nanyo-city.jpn.org/prompt/287.html',
'288' => 'https://nanyo-city.jpn.org/prompt/288.html',
'289' => 'https://nanyo-city.jpn.org/prompt/289.html',
'290' => 'https://nanyo-city.jpn.org/prompt/290.html',
'291' => 'https://nanyo-city.jpn.org/prompt/291.html',
'292' => 'https://nanyo-city.jpn.org/prompt/292.html',
'293' => 'https://nanyo-city.jpn.org/prompt/293.html',
'294' => 'https://nanyo-city.jpn.org/prompt/294.html',
'295' => 'https://nanyo-city.jpn.org/prompt/295.html',
'296' => 'https://nanyo-city.jpn.org/prompt/296.html',
'297' => 'https://nanyo-city.jpn.org/prompt/297.html',
'298' => 'https://nanyo-city.jpn.org/prompt/298.html',
'299' => 'https://nanyo-city.jpn.org/prompt/299.html',
'300' => 'https://nanyo-city.jpn.org/prompt/300.html',
'301' => 'https://nanyo-city.jpn.org/prompt/301.html',
'302' => 'https://nanyo-city.jpn.org/prompt/302.html',
'303' => 'https://nanyo-city.jpn.org/prompt/303.html',
'304' => 'https://nanyo-city.jpn.org/prompt/304.html',
'305' => 'https://nanyo-city.jpn.org/prompt/305.html',
'306' => 'https://nanyo-city.jpn.org/prompt/306.html',
'307' => 'https://nanyo-city.jpn.org/prompt/307.html',
'308' => 'https://nanyo-city.jpn.org/prompt/308.html',
'309' => 'https://nanyo-city.jpn.org/prompt/309.html',
'310' => 'https://nanyo-city.jpn.org/prompt/310.html',
'311' => 'https://nanyo-city.jpn.org/prompt/311.html',
'312' => 'https://nanyo-city.jpn.org/prompt/312.html',
'313' => 'https://nanyo-city.jpn.org/prompt/313.html',
'314' => 'https://nanyo-city.jpn.org/prompt/314.html',
'315' => 'https://nanyo-city.jpn.org/prompt/315.html',
'316' => 'https://nanyo-city.jpn.org/prompt/316.html',
'317' => 'https://nanyo-city.jpn.org/prompt/317.html',
'318' => 'https://nanyo-city.jpn.org/prompt/318.html',
'319' => 'https://nanyo-city.jpn.org/prompt/319.html',
'320' => 'https://nanyo-city.jpn.org/prompt/320.html',
'321' => 'https://nanyo-city.jpn.org/prompt/321.html',
'322' => 'https://nanyo-city.jpn.org/prompt/322.html',
'323' => 'https://nanyo-city.jpn.org/prompt/323.html',
'324' => 'https://nanyo-city.jpn.org/prompt/324.html',
'325' => 'https://nanyo-city.jpn.org/prompt/325.html',
'326' => 'https://nanyo-city.jpn.org/prompt/326.html',
'327' => 'https://nanyo-city.jpn.org/prompt/327.html',
'328' => 'https://nanyo-city.jpn.org/prompt/328.html',
'329' => 'https://nanyo-city.jpn.org/prompt/329.html',
'330' => 'https://nanyo-city.jpn.org/prompt/330.html',
'331' => 'https://nanyo-city.jpn.org/prompt/331.html',
'332' => 'https://nanyo-city.jpn.org/prompt/332.html',
'333' => 'https://nanyo-city.jpn.org/prompt/333.html',
'334' => 'https://nanyo-city.jpn.org/prompt/334.html',
'335' => 'https://nanyo-city.jpn.org/prompt/335.html',
'336' => 'https://nanyo-city.jpn.org/prompt/336.html',
'337' => 'https://nanyo-city.jpn.org/prompt/337.html',
'338' => 'https://nanyo-city.jpn.org/prompt/338.html',
'339' => 'https://nanyo-city.jpn.org/prompt/339.html',
'340' => 'https://nanyo-city.jpn.org/prompt/340.html',
'341' => 'https://nanyo-city.jpn.org/prompt/341.html',
'342' => 'https://nanyo-city.jpn.org/prompt/342.html',
'343' => 'https://nanyo-city.jpn.org/prompt/343.html',
'344' => 'https://nanyo-city.jpn.org/prompt/344.html',
'345' => 'https://nanyo-city.jpn.org/prompt/345.html',
'346' => 'https://nanyo-city.jpn.org/prompt/346.html',
'347' => 'https://nanyo-city.jpn.org/prompt/347.html',
'348' => 'https://nanyo-city.jpn.org/prompt/348.html',
'349' => 'https://nanyo-city.jpn.org/prompt/349.html',
'350' => 'https://nanyo-city.jpn.org/prompt/350.html',
'351' => 'https://nanyo-city.jpn.org/prompt/351.html',
'352' => 'https://nanyo-city.jpn.org/prompt/352.html',
'353' => 'https://nanyo-city.jpn.org/prompt/353.html',
'354' => 'https://nanyo-city.jpn.org/prompt/354.html',
'355' => 'https://nanyo-city.jpn.org/prompt/355.html',
'356' => 'https://nanyo-city.jpn.org/prompt/356.html',
'357' => 'https://nanyo-city.jpn.org/prompt/357.html',
'358' => 'https://nanyo-city.jpn.org/prompt/358.html',
'359' => 'https://nanyo-city.jpn.org/prompt/359.html',
'360' => 'https://nanyo-city.jpn.org/prompt/360.html',
'361' => 'https://nanyo-city.jpn.org/prompt/361.html',
'362' => 'https://nanyo-city.jpn.org/prompt/362.html',
'363' => 'https://nanyo-city.jpn.org/prompt/363.html',
'364' => 'https://nanyo-city.jpn.org/prompt/364.html',
'365' => 'https://nanyo-city.jpn.org/prompt/365.html',
'366' => 'https://nanyo-city.jpn.org/prompt/366.html',
'367' => 'https://nanyo-city.jpn.org/prompt/367.html',
'368' => 'https://nanyo-city.jpn.org/prompt/368.html',
'369' => 'https://nanyo-city.jpn.org/prompt/369.html',
'370' => 'https://nanyo-city.jpn.org/prompt/370.html',
'371' => 'https://nanyo-city.jpn.org/prompt/371.html',
'372' => 'https://nanyo-city.jpn.org/prompt/372.html',
'373' => 'https://nanyo-city.jpn.org/prompt/373.html',
'374' => 'https://nanyo-city.jpn.org/prompt/374.html',
'375' => 'https://nanyo-city.jpn.org/prompt/375.html',
'376' => 'https://nanyo-city.jpn.org/prompt/376.html',
'377' => 'https://nanyo-city.jpn.org/prompt/377.html',
'378' => 'https://nanyo-city.jpn.org/prompt/378.html',
'379' => 'https://nanyo-city.jpn.org/prompt/379.html',
'380' => 'https://nanyo-city.jpn.org/prompt/380.html',
'381' => 'https://nanyo-city.jpn.org/prompt/381.html',
'382' => 'https://nanyo-city.jpn.org/prompt/382.html',
'383' => 'https://nanyo-city.jpn.org/prompt/383.html',
'384' => 'https://nanyo-city.jpn.org/prompt/384.html',
'385' => 'https://nanyo-city.jpn.org/prompt/385.html',
'386' => 'https://nanyo-city.jpn.org/prompt/386.html',
'387' => 'https://nanyo-city.jpn.org/prompt/387.html',
'388' => 'https://nanyo-city.jpn.org/prompt/388.html',
'389' => 'https://nanyo-city.jpn.org/prompt/389.html',
'390' => 'https://nanyo-city.jpn.org/prompt/390.html',
'391' => 'https://nanyo-city.jpn.org/prompt/391.html',
'392' => 'https://nanyo-city.jpn.org/prompt/392.html',
'393' => 'https://nanyo-city.jpn.org/prompt/393.html',
'394' => 'https://nanyo-city.jpn.org/prompt/394.html',
'395' => 'https://nanyo-city.jpn.org/prompt/395.html',
'396' => 'https://nanyo-city.jpn.org/prompt/396.html',
'397' => 'https://nanyo-city.jpn.org/prompt/397.html',
'398' => 'https://nanyo-city.jpn.org/prompt/398.html',
'399' => 'https://nanyo-city.jpn.org/prompt/399.html',
'400' => 'https://nanyo-city.jpn.org/prompt/400.html',
'401' => 'https://nanyo-city.jpn.org/prompt/401.html',
'402' => 'https://nanyo-city.jpn.org/prompt/402.html',
'403' => 'https://nanyo-city.jpn.org/prompt/403.html',
'404' => 'https://nanyo-city.jpn.org/prompt/404.html',
'405' => 'https://nanyo-city.jpn.org/prompt/405.html',
'406' => 'https://nanyo-city.jpn.org/prompt/406.html',
'407' => 'https://nanyo-city.jpn.org/prompt/407.html',
'408' => 'https://nanyo-city.jpn.org/prompt/408.html',
'409' => 'https://nanyo-city.jpn.org/prompt/409.html',
'410' => 'https://nanyo-city.jpn.org/prompt/410.html',
'411' => 'https://nanyo-city.jpn.org/prompt/411.html',
'412' => 'https://nanyo-city.jpn.org/prompt/412.html',
'413' => 'https://nanyo-city.jpn.org/prompt/413.html',
'414' => 'https://nanyo-city.jpn.org/prompt/414.html',
'415' => 'https://nanyo-city.jpn.org/prompt/415.html',
'416' => 'https://nanyo-city.jpn.org/prompt/416.html',
'417' => 'https://nanyo-city.jpn.org/prompt/417.html',
'418' => 'https://nanyo-city.jpn.org/prompt/418.html',
'419' => 'https://nanyo-city.jpn.org/prompt/419.html',
'420' => 'https://nanyo-city.jpn.org/prompt/420.html',
'421' => 'https://nanyo-city.jpn.org/prompt/421.html',
'422' => 'https://nanyo-city.jpn.org/prompt/422.html',
'423' => 'https://nanyo-city.jpn.org/prompt/423.html',
'424' => 'https://nanyo-city.jpn.org/prompt/424.html',
'425' => 'https://nanyo-city.jpn.org/prompt/425.html',
'426' => 'https://nanyo-city.jpn.org/prompt/426.html',
'427' => 'https://nanyo-city.jpn.org/prompt/427.html',
'428' => 'https://nanyo-city.jpn.org/prompt/428.html',
'429' => 'https://nanyo-city.jpn.org/prompt/429.html',
'430' => 'https://nanyo-city.jpn.org/prompt/430.html',
'431' => 'https://nanyo-city.jpn.org/prompt/431.html',
'432' => 'https://nanyo-city.jpn.org/prompt/432.html',
'433' => 'https://nanyo-city.jpn.org/prompt/433.html',
'434' => 'https://nanyo-city.jpn.org/prompt/434.html',
'435' => 'https://nanyo-city.jpn.org/prompt/435.html',
'436' => 'https://nanyo-city.jpn.org/prompt/436.html',
'437' => 'https://nanyo-city.jpn.org/prompt/437.html',
'438' => 'https://nanyo-city.jpn.org/prompt/438.html',
'439' => 'https://nanyo-city.jpn.org/prompt/439.html',
'440' => 'https://nanyo-city.jpn.org/prompt/440.html',
'441' => 'https://nanyo-city.jpn.org/prompt/441.html',
'442' => 'https://nanyo-city.jpn.org/prompt/442.html',
'443' => 'https://nanyo-city.jpn.org/prompt/443.html',
'444' => 'https://nanyo-city.jpn.org/prompt/444.html',
'445' => 'https://nanyo-city.jpn.org/prompt/445.html',
'446' => 'https://nanyo-city.jpn.org/prompt/446.html',
'447' => 'https://nanyo-city.jpn.org/prompt/447.html',
'448' => 'https://nanyo-city.jpn.org/prompt/448.html',
'449' => 'https://nanyo-city.jpn.org/prompt/449.html',
'450' => 'https://nanyo-city.jpn.org/prompt/450.html',
'451' => 'https://nanyo-city.jpn.org/prompt/451.html',
'452' => 'https://nanyo-city.jpn.org/prompt/452.html',
'453' => 'https://nanyo-city.jpn.org/prompt/453.html',
'454' => 'https://nanyo-city.jpn.org/prompt/454.html',
'455' => 'https://nanyo-city.jpn.org/prompt/455.html',
'456' => 'https://nanyo-city.jpn.org/prompt/456.html',
'457' => 'https://nanyo-city.jpn.org/prompt/457.html',
'458' => 'https://nanyo-city.jpn.org/prompt/458.html',
'459' => 'https://nanyo-city.jpn.org/prompt/459.html',
'460' => 'https://nanyo-city.jpn.org/prompt/460.html',
'461' => 'https://nanyo-city.jpn.org/prompt/461.html',
'462' => 'https://nanyo-city.jpn.org/prompt/462.html',
'463' => 'https://nanyo-city.jpn.org/prompt/463.html',
'464' => 'https://nanyo-city.jpn.org/prompt/464.html',
'465' => 'https://nanyo-city.jpn.org/prompt/465.html',
'466' => 'https://nanyo-city.jpn.org/prompt/466.html',
'467' => 'https://nanyo-city.jpn.org/prompt/467.html',
'468' => 'https://nanyo-city.jpn.org/prompt/468.html',
'469' => 'https://nanyo-city.jpn.org/prompt/469.html',
'470' => 'https://nanyo-city.jpn.org/prompt/470.html',
'471' => 'https://nanyo-city.jpn.org/prompt/471.html',
'472' => 'https://nanyo-city.jpn.org/prompt/472.html',
'473' => 'https://nanyo-city.jpn.org/prompt/473.html',
'474' => 'https://nanyo-city.jpn.org/prompt/474.html',
'475' => 'https://nanyo-city.jpn.org/prompt/475.html',
'476' => 'https://nanyo-city.jpn.org/prompt/476.html',
'477' => 'https://nanyo-city.jpn.org/prompt/477.html',
'478' => 'https://nanyo-city.jpn.org/prompt/478.html',
'479' => 'https://nanyo-city.jpn.org/prompt/479.html',
'480' => 'https://nanyo-city.jpn.org/prompt/480.html',
'481' => 'https://nanyo-city.jpn.org/prompt/481.html',
'482' => 'https://nanyo-city.jpn.org/prompt/482.html',
'483' => 'https://nanyo-city.jpn.org/prompt/483.html',
'484' => 'https://nanyo-city.jpn.org/prompt/484.html',
'485' => 'https://nanyo-city.jpn.org/prompt/485.html',
'486' => 'https://nanyo-city.jpn.org/prompt/486.html',
'487' => 'https://nanyo-city.jpn.org/prompt/487.html',
'488' => 'https://nanyo-city.jpn.org/prompt/488.html',
'489' => 'https://nanyo-city.jpn.org/prompt/489.html',
'490' => 'https://nanyo-city.jpn.org/prompt/490.html',
'491' => 'https://nanyo-city.jpn.org/prompt/491.html',
'492' => 'https://nanyo-city.jpn.org/prompt/492.html',
'493' => 'https://nanyo-city.jpn.org/prompt/493.html',
'494' => 'https://nanyo-city.jpn.org/prompt/494.html',
'495' => 'https://nanyo-city.jpn.org/prompt/495.html',
'496' => 'https://nanyo-city.jpn.org/prompt/496.html',
'497' => 'https://nanyo-city.jpn.org/prompt/497.html',
'498' => 'https://nanyo-city.jpn.org/prompt/498.html',
'499' => 'https://nanyo-city.jpn.org/prompt/499.html',
'500' => 'https://nanyo-city.jpn.org/prompt/500.html',
'501' => 'https://nanyo-city.jpn.org/prompt/501.html',
'502' => 'https://nanyo-city.jpn.org/prompt/502.html',
'503' => 'https://nanyo-city.jpn.org/prompt/503.html',
'504' => 'https://nanyo-city.jpn.org/prompt/504.html',
'505' => 'https://nanyo-city.jpn.org/prompt/505.html',
'506' => 'https://nanyo-city.jpn.org/prompt/506.html',
'507' => 'https://nanyo-city.jpn.org/prompt/507.html',
'508' => 'https://nanyo-city.jpn.org/prompt/508.html',
'509' => 'https://nanyo-city.jpn.org/prompt/509.html',
'510' => 'https://nanyo-city.jpn.org/prompt/510.html',
'511' => 'https://nanyo-city.jpn.org/prompt/511.html',
'512' => 'https://nanyo-city.jpn.org/prompt/512.html',
'513' => 'https://nanyo-city.jpn.org/prompt/513.html',
'514' => 'https://nanyo-city.jpn.org/prompt/514.html',
'515' => 'https://nanyo-city.jpn.org/prompt/515.html',
'516' => 'https://nanyo-city.jpn.org/prompt/516.html',
'517' => 'https://nanyo-city.jpn.org/prompt/517.html',
'518' => 'https://nanyo-city.jpn.org/prompt/518.html',
'519' => 'https://nanyo-city.jpn.org/prompt/519.html',
'520' => 'https://nanyo-city.jpn.org/prompt/520.html',
'521' => 'https://nanyo-city.jpn.org/prompt/521.html',
'522' => 'https://nanyo-city.jpn.org/prompt/522.html',
'523' => 'https://nanyo-city.jpn.org/prompt/523.html',
'524' => 'https://nanyo-city.jpn.org/prompt/524.html',
'525' => 'https://nanyo-city.jpn.org/prompt/525.html',
'526' => 'https://nanyo-city.jpn.org/prompt/526.html',
'527' => 'https://nanyo-city.jpn.org/prompt/527.html',
'528' => 'https://nanyo-city.jpn.org/prompt/528.html',
'529' => 'https://nanyo-city.jpn.org/prompt/529.html',
'530' => 'https://nanyo-city.jpn.org/prompt/530.html',
'531' => 'https://nanyo-city.jpn.org/prompt/531.html',
'532' => 'https://nanyo-city.jpn.org/prompt/532.html',
'533' => 'https://nanyo-city.jpn.org/prompt/533.html',
'534' => 'https://nanyo-city.jpn.org/prompt/534.html',
'535' => 'https://nanyo-city.jpn.org/prompt/535.html',
'536' => 'https://nanyo-city.jpn.org/prompt/536.html',
'537' => 'https://nanyo-city.jpn.org/prompt/537.html',
'538' => 'https://nanyo-city.jpn.org/prompt/538.html',
'539' => 'https://nanyo-city.jpn.org/prompt/539.html',
'540' => 'https://nanyo-city.jpn.org/prompt/540.html',
'541' => 'https://nanyo-city.jpn.org/prompt/541.html',
'542' => 'https://nanyo-city.jpn.org/prompt/542.html',
'543' => 'https://nanyo-city.jpn.org/prompt/543.html',
'544' => 'https://nanyo-city.jpn.org/prompt/544.html',
'545' => 'https://nanyo-city.jpn.org/prompt/545.html',
'546' => 'https://nanyo-city.jpn.org/prompt/546.html',
'547' => 'https://nanyo-city.jpn.org/prompt/547.html',
'548' => 'https://nanyo-city.jpn.org/prompt/548.html',
'549' => 'https://nanyo-city.jpn.org/prompt/549.html',
'550' => 'https://nanyo-city.jpn.org/prompt/550.html',
'551' => 'https://nanyo-city.jpn.org/prompt/551.html',
'552' => 'https://nanyo-city.jpn.org/prompt/552.html',
'553' => 'https://nanyo-city.jpn.org/prompt/553.html',
'554' => 'https://nanyo-city.jpn.org/prompt/554.html',
'555' => 'https://nanyo-city.jpn.org/prompt/555.html',
'556' => 'https://nanyo-city.jpn.org/prompt/556.html',
'557' => 'https://nanyo-city.jpn.org/prompt/557.html',
'558' => 'https://nanyo-city.jpn.org/prompt/558.html',
'559' => 'https://nanyo-city.jpn.org/prompt/559.html',
'560' => 'https://nanyo-city.jpn.org/prompt/560.html',
'561' => 'https://nanyo-city.jpn.org/prompt/561.html',
'562' => 'https://nanyo-city.jpn.org/prompt/562.html',
'563' => 'https://nanyo-city.jpn.org/prompt/563.html',
'564' => 'https://nanyo-city.jpn.org/prompt/564.html',
'565' => 'https://nanyo-city.jpn.org/prompt/565.html',
'566' => 'https://nanyo-city.jpn.org/prompt/566.html',
'567' => 'https://nanyo-city.jpn.org/prompt/567.html',
'568' => 'https://nanyo-city.jpn.org/prompt/568.html',
'569' => 'https://nanyo-city.jpn.org/prompt/569.html',
'570' => 'https://nanyo-city.jpn.org/prompt/570.html',
'571' => 'https://nanyo-city.jpn.org/prompt/571.html',
'572' => 'https://nanyo-city.jpn.org/prompt/572.html',
'573' => 'https://nanyo-city.jpn.org/prompt/573.html',
'574' => 'https://nanyo-city.jpn.org/prompt/574.html',
'575' => 'https://nanyo-city.jpn.org/prompt/575.html',
'576' => 'https://nanyo-city.jpn.org/prompt/576.html',
'577' => 'https://nanyo-city.jpn.org/prompt/577.html',
'578' => 'https://nanyo-city.jpn.org/prompt/578.html',
'579' => 'https://nanyo-city.jpn.org/prompt/579.html',
'580' => 'https://nanyo-city.jpn.org/prompt/580.html',
'581' => 'https://nanyo-city.jpn.org/prompt/581.html',
'582' => 'https://nanyo-city.jpn.org/prompt/582.html',
'583' => 'https://nanyo-city.jpn.org/prompt/583.html',
'584' => 'https://nanyo-city.jpn.org/prompt/584.html',
'585' => 'https://nanyo-city.jpn.org/prompt/585.html',
'586' => 'https://nanyo-city.jpn.org/prompt/586.html',
'587' => 'https://nanyo-city.jpn.org/prompt/587.html',
'588' => 'https://nanyo-city.jpn.org/prompt/588.html',
'589' => 'https://nanyo-city.jpn.org/prompt/589.html',
'590' => 'https://nanyo-city.jpn.org/prompt/590.html',
'591' => 'https://nanyo-city.jpn.org/prompt/591.html',
'592' => 'https://nanyo-city.jpn.org/prompt/592.html',
'593' => 'https://nanyo-city.jpn.org/prompt/593.html',
'594' => 'https://nanyo-city.jpn.org/prompt/594.html',
'595' => 'https://nanyo-city.jpn.org/prompt/595.html',
'596' => 'https://nanyo-city.jpn.org/prompt/596.html',
'597' => 'https://nanyo-city.jpn.org/prompt/597.html',
'598' => 'https://nanyo-city.jpn.org/prompt/598.html',
'599' => 'https://nanyo-city.jpn.org/prompt/599.html',
'600' => 'https://nanyo-city.jpn.org/prompt/600.html',
'601' => 'https://nanyo-city.jpn.org/prompt/601.html',
'602' => 'https://nanyo-city.jpn.org/prompt/602.html',
'603' => 'https://nanyo-city.jpn.org/prompt/603.html',
'604' => 'https://nanyo-city.jpn.org/prompt/604.html',
'605' => 'https://nanyo-city.jpn.org/prompt/605.html',
'606' => 'https://nanyo-city.jpn.org/prompt/606.html',
'607' => 'https://nanyo-city.jpn.org/prompt/607.html',
'608' => 'https://nanyo-city.jpn.org/prompt/608.html',
'609' => 'https://nanyo-city.jpn.org/prompt/609.html',
'610' => 'https://nanyo-city.jpn.org/prompt/610.html',
'611' => 'https://nanyo-city.jpn.org/prompt/611.html',
'612' => 'https://nanyo-city.jpn.org/prompt/612.html',
'613' => 'https://nanyo-city.jpn.org/prompt/613.html',
'614' => 'https://nanyo-city.jpn.org/prompt/614.html',
'615' => 'https://nanyo-city.jpn.org/prompt/615.html',
'616' => 'https://nanyo-city.jpn.org/prompt/616.html',
'617' => 'https://nanyo-city.jpn.org/prompt/617.html',
'618' => 'https://nanyo-city.jpn.org/prompt/618.html',
'619' => 'https://nanyo-city.jpn.org/prompt/619.html',
'620' => 'https://nanyo-city.jpn.org/prompt/620.html',
'621' => 'https://nanyo-city.jpn.org/prompt/621.html',
'622' => 'https://nanyo-city.jpn.org/prompt/622.html',
'623' => 'https://nanyo-city.jpn.org/prompt/623.html',
'624' => 'https://nanyo-city.jpn.org/prompt/624.html',
'625' => 'https://nanyo-city.jpn.org/prompt/625.html',
'626' => 'https://nanyo-city.jpn.org/prompt/626.html',
'627' => 'https://nanyo-city.jpn.org/prompt/627.html',
'628' => 'https://nanyo-city.jpn.org/prompt/628.html',
'629' => 'https://nanyo-city.jpn.org/prompt/629.html',
'630' => 'https://nanyo-city.jpn.org/prompt/630.html',
'631' => 'https://nanyo-city.jpn.org/prompt/631.html',
'632' => 'https://nanyo-city.jpn.org/prompt/632.html',
'633' => 'https://nanyo-city.jpn.org/prompt/633.html',
'634' => 'https://nanyo-city.jpn.org/prompt/634.html',
'635' => 'https://nanyo-city.jpn.org/prompt/635.html',
'636' => 'https://nanyo-city.jpn.org/prompt/636.html',
'637' => 'https://nanyo-city.jpn.org/prompt/637.html',
'638' => 'https://nanyo-city.jpn.org/prompt/638.html',
'639' => 'https://nanyo-city.jpn.org/prompt/639.html',
'640' => 'https://nanyo-city.jpn.org/prompt/640.html',
'641' => 'https://nanyo-city.jpn.org/prompt/641.html',
'642' => 'https://nanyo-city.jpn.org/prompt/642.html',
'643' => 'https://nanyo-city.jpn.org/prompt/643.html',
'644' => 'https://nanyo-city.jpn.org/prompt/644.html',
'645' => 'https://nanyo-city.jpn.org/prompt/645.html',
'646' => 'https://nanyo-city.jpn.org/prompt/646.html',
'647' => 'https://nanyo-city.jpn.org/prompt/647.html',
'648' => 'https://nanyo-city.jpn.org/prompt/648.html',
'649' => 'https://nanyo-city.jpn.org/prompt/649.html',
'650' => 'https://nanyo-city.jpn.org/prompt/650.html',
'651' => 'https://nanyo-city.jpn.org/prompt/651.html',
'652' => 'https://nanyo-city.jpn.org/prompt/652.html',
'653' => 'https://nanyo-city.jpn.org/prompt/653.html',
'654' => 'https://nanyo-city.jpn.org/prompt/654.html',
'655' => 'https://nanyo-city.jpn.org/prompt/655.html',
'656' => 'https://nanyo-city.jpn.org/prompt/656.html',
'657' => 'https://nanyo-city.jpn.org/prompt/657.html',
'658' => 'https://nanyo-city.jpn.org/prompt/658.html',
'659' => 'https://nanyo-city.jpn.org/prompt/659.html',
'660' => 'https://nanyo-city.jpn.org/prompt/660.html',
'661' => 'https://nanyo-city.jpn.org/prompt/661.html',
'662' => 'https://nanyo-city.jpn.org/prompt/662.html',
'663' => 'https://nanyo-city.jpn.org/prompt/663.html',
'664' => 'https://nanyo-city.jpn.org/prompt/664.html',
'665' => 'https://nanyo-city.jpn.org/prompt/665.html',
'666' => 'https://nanyo-city.jpn.org/prompt/666.html',
'667' => 'https://nanyo-city.jpn.org/prompt/667.html',
'668' => 'https://nanyo-city.jpn.org/prompt/668.html',
'669' => 'https://nanyo-city.jpn.org/prompt/669.html',
'670' => 'https://nanyo-city.jpn.org/prompt/670.html',
'671' => 'https://nanyo-city.jpn.org/prompt/671.html',
'672' => 'https://nanyo-city.jpn.org/prompt/672.html',
'673' => 'https://nanyo-city.jpn.org/prompt/673.html',
'674' => 'https://nanyo-city.jpn.org/prompt/674.html',
'675' => 'https://nanyo-city.jpn.org/prompt/675.html',
'676' => 'https://nanyo-city.jpn.org/prompt/676.html',
'677' => 'https://nanyo-city.jpn.org/prompt/677.html',
'678' => 'https://nanyo-city.jpn.org/prompt/678.html',
'679' => 'https://nanyo-city.jpn.org/prompt/679.html',
'680' => 'https://nanyo-city.jpn.org/prompt/680.html',
'681' => 'https://nanyo-city.jpn.org/prompt/681.html',
'682' => 'https://nanyo-city.jpn.org/prompt/682.html',
'683' => 'https://nanyo-city.jpn.org/prompt/683.html',
'684' => 'https://nanyo-city.jpn.org/prompt/684.html',
'685' => 'https://nanyo-city.jpn.org/prompt/685.html',
'686' => 'https://nanyo-city.jpn.org/prompt/686.html',
'687' => 'https://nanyo-city.jpn.org/prompt/687.html',
'688' => 'https://nanyo-city.jpn.org/prompt/688.html',
'689' => 'https://nanyo-city.jpn.org/prompt/689.html',
'690' => 'https://nanyo-city.jpn.org/prompt/690.html',
'691' => 'https://nanyo-city.jpn.org/prompt/691.html',
'692' => 'https://nanyo-city.jpn.org/prompt/692.html',
'693' => 'https://nanyo-city.jpn.org/prompt/693.html',
'694' => 'https://nanyo-city.jpn.org/prompt/694.html',
'695' => 'https://nanyo-city.jpn.org/prompt/695.html',
'696' => 'https://nanyo-city.jpn.org/prompt/696.html',
'697' => 'https://nanyo-city.jpn.org/prompt/697.html',
'698' => 'https://nanyo-city.jpn.org/prompt/698.html',
'699' => 'https://nanyo-city.jpn.org/prompt/699.html',
'700' => 'https://nanyo-city.jpn.org/prompt/700.html',
'701' => 'https://nanyo-city.jpn.org/prompt/701.html',
'702' => 'https://nanyo-city.jpn.org/prompt/702.html',
'703' => 'https://nanyo-city.jpn.org/prompt/703.html',
'704' => 'https://nanyo-city.jpn.org/prompt/704.html',
'705' => 'https://nanyo-city.jpn.org/prompt/705.html',
'706' => 'https://nanyo-city.jpn.org/prompt/706.html',
'707' => 'https://nanyo-city.jpn.org/prompt/707.html',
'708' => 'https://nanyo-city.jpn.org/prompt/708.html',
'709' => 'https://nanyo-city.jpn.org/prompt/709.html',
'710' => 'https://nanyo-city.jpn.org/prompt/710.html',
'711' => 'https://nanyo-city.jpn.org/prompt/711.html',
'712' => 'https://nanyo-city.jpn.org/prompt/712.html',
'713' => 'https://nanyo-city.jpn.org/prompt/713.html',
'714' => 'https://nanyo-city.jpn.org/prompt/714.html',
'715' => 'https://nanyo-city.jpn.org/prompt/715.html',
'716' => 'https://nanyo-city.jpn.org/prompt/716.html',
'717' => 'https://nanyo-city.jpn.org/prompt/717.html',
'718' => 'https://nanyo-city.jpn.org/prompt/718.html',
'719' => 'https://nanyo-city.jpn.org/prompt/719.html',
'720' => 'https://nanyo-city.jpn.org/prompt/720.html',
'721' => 'https://nanyo-city.jpn.org/prompt/721.html',
'722' => 'https://nanyo-city.jpn.org/prompt/722.html',
'723' => 'https://nanyo-city.jpn.org/prompt/723.html',
'724' => 'https://nanyo-city.jpn.org/prompt/724.html',
'725' => 'https://nanyo-city.jpn.org/prompt/725.html',
'726' => 'https://nanyo-city.jpn.org/prompt/726.html',
'727' => 'https://nanyo-city.jpn.org/prompt/727.html',
'728' => 'https://nanyo-city.jpn.org/prompt/728.html',
'729' => 'https://nanyo-city.jpn.org/prompt/729.html',
'730' => 'https://nanyo-city.jpn.org/prompt/730.html',
'731' => 'https://nanyo-city.jpn.org/prompt/731.html',
'732' => 'https://nanyo-city.jpn.org/prompt/732.html',
'733' => 'https://nanyo-city.jpn.org/prompt/733.html',
'734' => 'https://nanyo-city.jpn.org/prompt/734.html',
'735' => 'https://nanyo-city.jpn.org/prompt/735.html',
'736' => 'https://nanyo-city.jpn.org/prompt/736.html',
'737' => 'https://nanyo-city.jpn.org/prompt/737.html',
'738' => 'https://nanyo-city.jpn.org/prompt/738.html',
'739' => 'https://nanyo-city.jpn.org/prompt/739.html',
'740' => 'https://nanyo-city.jpn.org/prompt/740.html',
'741' => 'https://nanyo-city.jpn.org/prompt/741.html',
'742' => 'https://nanyo-city.jpn.org/prompt/742.html',
'743' => 'https://nanyo-city.jpn.org/prompt/743.html',
'744' => 'https://nanyo-city.jpn.org/prompt/744.html',
'745' => 'https://nanyo-city.jpn.org/prompt/745.html',
'746' => 'https://nanyo-city.jpn.org/prompt/746.html',
'747' => 'https://nanyo-city.jpn.org/prompt/747.html',
'748' => 'https://nanyo-city.jpn.org/prompt/748.html',
'749' => 'https://nanyo-city.jpn.org/prompt/749.html',
'750' => 'https://nanyo-city.jpn.org/prompt/750.html',
'751' => 'https://nanyo-city.jpn.org/prompt/751.html',
'752' => 'https://nanyo-city.jpn.org/prompt/752.html',
'753' => 'https://nanyo-city.jpn.org/prompt/753.html',
'754' => 'https://nanyo-city.jpn.org/prompt/754.html',
'755' => 'https://nanyo-city.jpn.org/prompt/755.html',
'756' => 'https://nanyo-city.jpn.org/prompt/756.html',
'757' => 'https://nanyo-city.jpn.org/prompt/757.html',
'758' => 'https://nanyo-city.jpn.org/prompt/758.html',
'759' => 'https://nanyo-city.jpn.org/prompt/759.html',
'760' => 'https://nanyo-city.jpn.org/prompt/760.html',
'761' => 'https://nanyo-city.jpn.org/prompt/761.html',
'762' => 'https://nanyo-city.jpn.org/prompt/762.html',
'763' => 'https://nanyo-city.jpn.org/prompt/763.html',
'764' => 'https://nanyo-city.jpn.org/prompt/764.html',
'765' => 'https://nanyo-city.jpn.org/prompt/765.html',
'766' => 'https://nanyo-city.jpn.org/prompt/766.html',
'767' => 'https://nanyo-city.jpn.org/prompt/767.html',
'768' => 'https://nanyo-city.jpn.org/prompt/768.html',
'769' => 'https://nanyo-city.jpn.org/prompt/769.html',
'770' => 'https://nanyo-city.jpn.org/prompt/770.html',
'771' => 'https://nanyo-city.jpn.org/prompt/771.html',
'772' => 'https://nanyo-city.jpn.org/prompt/772.html',
'773' => 'https://nanyo-city.jpn.org/prompt/773.html',
'774' => 'https://nanyo-city.jpn.org/prompt/774.html',
'775' => 'https://nanyo-city.jpn.org/prompt/775.html',
'776' => 'https://nanyo-city.jpn.org/prompt/776.html',
'777' => 'https://nanyo-city.jpn.org/prompt/777.html',
'778' => 'https://nanyo-city.jpn.org/prompt/778.html',
'779' => 'https://nanyo-city.jpn.org/prompt/779.html',
'780' => 'https://nanyo-city.jpn.org/prompt/780.html',
'781' => 'https://nanyo-city.jpn.org/prompt/781.html',
'782' => 'https://nanyo-city.jpn.org/prompt/782.html',
'783' => 'https://nanyo-city.jpn.org/prompt/783.html',
'784' => 'https://nanyo-city.jpn.org/prompt/784.html',
'785' => 'https://nanyo-city.jpn.org/prompt/785.html',
'786' => 'https://nanyo-city.jpn.org/prompt/786.html',
'787' => 'https://nanyo-city.jpn.org/prompt/787.html',
'788' => 'https://nanyo-city.jpn.org/prompt/788.html',
'789' => 'https://nanyo-city.jpn.org/prompt/789.html',
'790' => 'https://nanyo-city.jpn.org/prompt/790.html',
'791' => 'https://nanyo-city.jpn.org/prompt/791.html',
'792' => 'https://nanyo-city.jpn.org/prompt/792.html',
'793' => 'https://nanyo-city.jpn.org/prompt/793.html',
'794' => 'https://nanyo-city.jpn.org/prompt/794.html',
'795' => 'https://nanyo-city.jpn.org/prompt/795.html',
'796' => 'https://nanyo-city.jpn.org/prompt/796.html',
'797' => 'https://nanyo-city.jpn.org/prompt/797.html',
'798' => 'https://nanyo-city.jpn.org/prompt/798.html',
'799' => 'https://nanyo-city.jpn.org/prompt/799.html',
'800' => 'https://nanyo-city.jpn.org/prompt/800.html',
'801' => 'https://nanyo-city.jpn.org/prompt/801.html',
'802' => 'https://nanyo-city.jpn.org/prompt/802.html',
'803' => 'https://nanyo-city.jpn.org/prompt/803.html',
'804' => 'https://nanyo-city.jpn.org/prompt/804.html',
'805' => 'https://nanyo-city.jpn.org/prompt/805.html',
'806' => 'https://nanyo-city.jpn.org/prompt/806.html',
'807' => 'https://nanyo-city.jpn.org/prompt/807.html',
'808' => 'https://nanyo-city.jpn.org/prompt/808.html',
'809' => 'https://nanyo-city.jpn.org/prompt/809.html',
'810' => 'https://nanyo-city.jpn.org/prompt/810.html',
'811' => 'https://nanyo-city.jpn.org/prompt/811.html',
'812' => 'https://nanyo-city.jpn.org/prompt/812.html',
'813' => 'https://nanyo-city.jpn.org/prompt/813.html',
'814' => 'https://nanyo-city.jpn.org/prompt/814.html',
'815' => 'https://nanyo-city.jpn.org/prompt/815.html',
'816' => 'https://nanyo-city.jpn.org/prompt/816.html',
'817' => 'https://nanyo-city.jpn.org/prompt/817.html',
'818' => 'https://nanyo-city.jpn.org/prompt/818.html',
'819' => 'https://nanyo-city.jpn.org/prompt/819.html',
'820' => 'https://nanyo-city.jpn.org/prompt/820.html',
'821' => 'https://nanyo-city.jpn.org/prompt/821.html',
'822' => 'https://nanyo-city.jpn.org/prompt/822.html',
'823' => 'https://nanyo-city.jpn.org/prompt/823.html',
'824' => 'https://nanyo-city.jpn.org/prompt/824.html',
'825' => 'https://nanyo-city.jpn.org/prompt/825.html',
'826' => 'https://nanyo-city.jpn.org/prompt/826.html',
'827' => 'https://nanyo-city.jpn.org/prompt/827.html',
'828' => 'https://nanyo-city.jpn.org/prompt/828.html',
'829' => 'https://nanyo-city.jpn.org/prompt/829.html',
'830' => 'https://nanyo-city.jpn.org/prompt/830.html',
'831' => 'https://nanyo-city.jpn.org/prompt/831.html',
'832' => 'https://nanyo-city.jpn.org/prompt/832.html',
'833' => 'https://nanyo-city.jpn.org/prompt/833.html',
'834' => 'https://nanyo-city.jpn.org/prompt/834.html',
'835' => 'https://nanyo-city.jpn.org/prompt/835.html',
'836' => 'https://nanyo-city.jpn.org/prompt/836.html',
'837' => 'https://nanyo-city.jpn.org/prompt/837.html',
'838' => 'https://nanyo-city.jpn.org/prompt/838.html',
'839' => 'https://nanyo-city.jpn.org/prompt/839.html',
'840' => 'https://nanyo-city.jpn.org/prompt/840.html',
'841' => 'https://nanyo-city.jpn.org/prompt/841.html',
'842' => 'https://nanyo-city.jpn.org/prompt/842.html',
'843' => 'https://nanyo-city.jpn.org/prompt/843.html',
'844' => 'https://nanyo-city.jpn.org/prompt/844.html',
'845' => 'https://nanyo-city.jpn.org/prompt/845.html',
'846' => 'https://nanyo-city.jpn.org/prompt/846.html',
'847' => 'https://nanyo-city.jpn.org/prompt/847.html',
'848' => 'https://nanyo-city.jpn.org/prompt/848.html',
'849' => 'https://nanyo-city.jpn.org/prompt/849.html',
'850' => 'https://nanyo-city.jpn.org/prompt/850.html',
'851' => 'https://nanyo-city.jpn.org/prompt/851.html',
'852' => 'https://nanyo-city.jpn.org/prompt/852.html',
'853' => 'https://nanyo-city.jpn.org/prompt/853.html',
'854' => 'https://nanyo-city.jpn.org/prompt/854.html',
'855' => 'https://nanyo-city.jpn.org/prompt/855.html',
'856' => 'https://nanyo-city.jpn.org/prompt/856.html',
'857' => 'https://nanyo-city.jpn.org/prompt/857.html',
'858' => 'https://nanyo-city.jpn.org/prompt/858.html',
'859' => 'https://nanyo-city.jpn.org/prompt/859.html',
'860' => 'https://nanyo-city.jpn.org/prompt/860.html',
'861' => 'https://nanyo-city.jpn.org/prompt/861.html',
'862' => 'https://nanyo-city.jpn.org/prompt/862.html',
'863' => 'https://nanyo-city.jpn.org/prompt/863.html',
'864' => 'https://nanyo-city.jpn.org/prompt/864.html',
'865' => 'https://nanyo-city.jpn.org/prompt/865.html',
'866' => 'https://nanyo-city.jpn.org/prompt/866.html',
'867' => 'https://nanyo-city.jpn.org/prompt/867.html',
'868' => 'https://nanyo-city.jpn.org/prompt/868.html',
'869' => 'https://nanyo-city.jpn.org/prompt/869.html',
'870' => 'https://nanyo-city.jpn.org/prompt/870.html',
'871' => 'https://nanyo-city.jpn.org/prompt/871.html',
'872' => 'https://nanyo-city.jpn.org/prompt/872.html',
'873' => 'https://nanyo-city.jpn.org/prompt/873.html',
'874' => 'https://nanyo-city.jpn.org/prompt/874.html',
'875' => 'https://nanyo-city.jpn.org/prompt/875.html',
'876' => 'https://nanyo-city.jpn.org/prompt/876.html',
'877' => 'https://nanyo-city.jpn.org/prompt/877.html',
'878' => 'https://nanyo-city.jpn.org/prompt/878.html',
'879' => 'https://nanyo-city.jpn.org/prompt/879.html',
'880' => 'https://nanyo-city.jpn.org/prompt/880.html',
'881' => 'https://nanyo-city.jpn.org/prompt/881.html',
'882' => 'https://nanyo-city.jpn.org/prompt/882.html',
'883' => 'https://nanyo-city.jpn.org/prompt/883.html',
'884' => 'https://nanyo-city.jpn.org/prompt/884.html',
'885' => 'https://nanyo-city.jpn.org/prompt/885.html',
'886' => 'https://nanyo-city.jpn.org/prompt/886.html',
'887' => 'https://nanyo-city.jpn.org/prompt/887.html',
'888' => 'https://nanyo-city.jpn.org/prompt/888.html',
'889' => 'https://nanyo-city.jpn.org/prompt/889.html',
'890' => 'https://nanyo-city.jpn.org/prompt/890.html',
'891' => 'https://nanyo-city.jpn.org/prompt/891.html',
'892' => 'https://nanyo-city.jpn.org/prompt/892.html',
'893' => 'https://nanyo-city.jpn.org/prompt/893.html',
'894' => 'https://nanyo-city.jpn.org/prompt/894.html',
'895' => 'https://nanyo-city.jpn.org/prompt/895.html',
'896' => 'https://nanyo-city.jpn.org/prompt/896.html',
'897' => 'https://nanyo-city.jpn.org/prompt/897.html',
'898' => 'https://nanyo-city.jpn.org/prompt/898.html',
'899' => 'https://nanyo-city.jpn.org/prompt/899.html',
'900' => 'https://nanyo-city.jpn.org/prompt/900.html',
'901' => 'https://nanyo-city.jpn.org/prompt/901.html',
'902' => 'https://nanyo-city.jpn.org/prompt/902.html',
'903' => 'https://nanyo-city.jpn.org/prompt/903.html',
'904' => 'https://nanyo-city.jpn.org/prompt/904.html',
'905' => 'https://nanyo-city.jpn.org/prompt/905.html',
'906' => 'https://nanyo-city.jpn.org/prompt/906.html',
'907' => 'https://nanyo-city.jpn.org/prompt/907.html',
'908' => 'https://nanyo-city.jpn.org/prompt/908.html',
'909' => 'https://nanyo-city.jpn.org/prompt/909.html',
'910' => 'https://nanyo-city.jpn.org/prompt/910.html',
'911' => 'https://nanyo-city.jpn.org/prompt/911.html',
'912' => 'https://nanyo-city.jpn.org/prompt/912.html',
'913' => 'https://nanyo-city.jpn.org/prompt/913.html',
'914' => 'https://nanyo-city.jpn.org/prompt/914.html',
'915' => 'https://nanyo-city.jpn.org/prompt/915.html',
'916' => 'https://nanyo-city.jpn.org/prompt/916.html',
'917' => 'https://nanyo-city.jpn.org/prompt/917.html',
'918' => 'https://nanyo-city.jpn.org/prompt/918.html',
'919' => 'https://nanyo-city.jpn.org/prompt/919.html',
'920' => 'https://nanyo-city.jpn.org/prompt/920.html',
'921' => 'https://nanyo-city.jpn.org/prompt/921.html',
'922' => 'https://nanyo-city.jpn.org/prompt/922.html',
'923' => 'https://nanyo-city.jpn.org/prompt/923.html',
'924' => 'https://nanyo-city.jpn.org/prompt/924.html',
'925' => 'https://nanyo-city.jpn.org/prompt/925.html',
'926' => 'https://nanyo-city.jpn.org/prompt/926.html',
'927' => 'https://nanyo-city.jpn.org/prompt/927.html',
'928' => 'https://nanyo-city.jpn.org/prompt/928.html',
'929' => 'https://nanyo-city.jpn.org/prompt/929.html',
'930' => 'https://nanyo-city.jpn.org/prompt/930.html',
'931' => 'https://nanyo-city.jpn.org/prompt/931.html',
'932' => 'https://nanyo-city.jpn.org/prompt/932.html',
'933' => 'https://nanyo-city.jpn.org/prompt/933.html',
'934' => 'https://nanyo-city.jpn.org/prompt/934.html',
'935' => 'https://nanyo-city.jpn.org/prompt/935.html',
'936' => 'https://nanyo-city.jpn.org/prompt/936.html',
'937' => 'https://nanyo-city.jpn.org/prompt/937.html',
'938' => 'https://nanyo-city.jpn.org/prompt/938.html',
'939' => 'https://nanyo-city.jpn.org/prompt/939.html',
'940' => 'https://nanyo-city.jpn.org/prompt/940.html',
'941' => 'https://nanyo-city.jpn.org/prompt/941.html',
'942' => 'https://nanyo-city.jpn.org/prompt/942.html',
'943' => 'https://nanyo-city.jpn.org/prompt/943.html',
'944' => 'https://nanyo-city.jpn.org/prompt/944.html',
'945' => 'https://nanyo-city.jpn.org/prompt/945.html',
'946' => 'https://nanyo-city.jpn.org/prompt/946.html',
'947' => 'https://nanyo-city.jpn.org/prompt/947.html',
'948' => 'https://nanyo-city.jpn.org/prompt/948.html',
'949' => 'https://nanyo-city.jpn.org/prompt/949.html',
'950' => 'https://nanyo-city.jpn.org/prompt/950.html',
'951' => 'https://nanyo-city.jpn.org/prompt/951.html',
'952' => 'https://nanyo-city.jpn.org/prompt/952.html',
'953' => 'https://nanyo-city.jpn.org/prompt/953.html',
'954' => 'https://nanyo-city.jpn.org/prompt/954.html',
'955' => 'https://nanyo-city.jpn.org/prompt/955.html',
'956' => 'https://nanyo-city.jpn.org/prompt/956.html',
'957' => 'https://nanyo-city.jpn.org/prompt/957.html',
'958' => 'https://nanyo-city.jpn.org/prompt/958.html',
'959' => 'https://nanyo-city.jpn.org/prompt/959.html',
'960' => 'https://nanyo-city.jpn.org/prompt/960.html',
'961' => 'https://nanyo-city.jpn.org/prompt/961.html',
'962' => 'https://nanyo-city.jpn.org/prompt/962.html',
'963' => 'https://nanyo-city.jpn.org/prompt/963.html',
'964' => 'https://nanyo-city.jpn.org/prompt/964.html',
'965' => 'https://nanyo-city.jpn.org/prompt/965.html',
'966' => 'https://nanyo-city.jpn.org/prompt/966.html',
'967' => 'https://nanyo-city.jpn.org/prompt/967.html',
'968' => 'https://nanyo-city.jpn.org/prompt/968.html',
'969' => 'https://nanyo-city.jpn.org/prompt/969.html',
'970' => 'https://nanyo-city.jpn.org/prompt/970.html',
'971' => 'https://nanyo-city.jpn.org/prompt/971.html',
'972' => 'https://nanyo-city.jpn.org/prompt/972.html',
'973' => 'https://nanyo-city.jpn.org/prompt/973.html',
'974' => 'https://nanyo-city.jpn.org/prompt/974.html',
'975' => 'https://nanyo-city.jpn.org/prompt/975.html',
'976' => 'https://nanyo-city.jpn.org/prompt/976.html',
'977' => 'https://nanyo-city.jpn.org/prompt/977.html',
'978' => 'https://nanyo-city.jpn.org/prompt/978.html',
'979' => 'https://nanyo-city.jpn.org/prompt/979.html',
'980' => 'https://nanyo-city.jpn.org/prompt/980.html',
'981' => 'https://nanyo-city.jpn.org/prompt/981.html',
'982' => 'https://nanyo-city.jpn.org/prompt/982.html',
'983' => 'https://nanyo-city.jpn.org/prompt/983.html',
'984' => 'https://nanyo-city.jpn.org/prompt/984.html',
'985' => 'https://nanyo-city.jpn.org/prompt/985.html',
'986' => 'https://nanyo-city.jpn.org/prompt/986.html',
'987' => 'https://nanyo-city.jpn.org/prompt/987.html',
'988' => 'https://nanyo-city.jpn.org/prompt/988.html',
'989' => 'https://nanyo-city.jpn.org/prompt/989.html',
'990' => 'https://nanyo-city.jpn.org/prompt/990.html',
'991' => 'https://nanyo-city.jpn.org/prompt/991.html',
'992' => 'https://nanyo-city.jpn.org/prompt/992.html',
'993' => 'https://nanyo-city.jpn.org/prompt/993.html',
'994' => 'https://nanyo-city.jpn.org/prompt/994.html',
'995' => 'https://nanyo-city.jpn.org/prompt/995.html',
'996' => 'https://nanyo-city.jpn.org/prompt/996.html',
'997' => 'https://nanyo-city.jpn.org/prompt/997.html',
'998' => 'https://nanyo-city.jpn.org/prompt/998.html',
'999' => 'https://nanyo-city.jpn.org/prompt/999.html',
'1000' => 'https://nanyo-city.jpn.org/prompt/1000.html',
'1001' => 'https://nanyo-city.jpn.org/prompt/1001.html',
'1002' => 'https://nanyo-city.jpn.org/prompt/1002.html',
'1003' => 'https://nanyo-city.jpn.org/prompt/1003.html',
'1004' => 'https://nanyo-city.jpn.org/prompt/1004.html',
'1005' => 'https://nanyo-city.jpn.org/prompt/1005.html',
'1006' => 'https://nanyo-city.jpn.org/prompt/1006.html',
'1007' => 'https://nanyo-city.jpn.org/prompt/1007.html',
'1008' => 'https://nanyo-city.jpn.org/prompt/1008.html',
'1009' => 'https://nanyo-city.jpn.org/prompt/1009.html',
'1010' => 'https://nanyo-city.jpn.org/prompt/1010.html',
'1011' => 'https://nanyo-city.jpn.org/prompt/1011.html',
'1012' => 'https://nanyo-city.jpn.org/prompt/1012.html',
'1013' => 'https://nanyo-city.jpn.org/prompt/1013.html',
'1014' => 'https://nanyo-city.jpn.org/prompt/1014.html',
'1015' => 'https://nanyo-city.jpn.org/prompt/1015.html',
'1016' => 'https://nanyo-city.jpn.org/prompt/1016.html',
'1017' => 'https://nanyo-city.jpn.org/prompt/1017.html',
'1018' => 'https://nanyo-city.jpn.org/prompt/1018.html',
'1019' => 'https://nanyo-city.jpn.org/prompt/1019.html',
'1020' => 'https://nanyo-city.jpn.org/prompt/1020.html',
'1021' => 'https://nanyo-city.jpn.org/prompt/1021.html',
'1022' => 'https://nanyo-city.jpn.org/prompt/1022.html',
'1023' => 'https://nanyo-city.jpn.org/prompt/1023.html',
'1024' => 'https://nanyo-city.jpn.org/prompt/1024.html',
'1025' => 'https://nanyo-city.jpn.org/prompt/1025.html',
'1026' => 'https://nanyo-city.jpn.org/prompt/1026.html',
'1027' => 'https://nanyo-city.jpn.org/prompt/1027.html',
'1028' => 'https://nanyo-city.jpn.org/prompt/1028.html',
'1029' => 'https://nanyo-city.jpn.org/prompt/1029.html',
'1030' => 'https://nanyo-city.jpn.org/prompt/1030.html',
'1031' => 'https://nanyo-city.jpn.org/prompt/1031.html',
'1032' => 'https://nanyo-city.jpn.org/prompt/1032.html',
'1033' => 'https://nanyo-city.jpn.org/prompt/1033.html',
'1034' => 'https://nanyo-city.jpn.org/prompt/1034.html',
'1035' => 'https://nanyo-city.jpn.org/prompt/1035.html',
'1036' => 'https://nanyo-city.jpn.org/prompt/1036.html',
'1037' => 'https://nanyo-city.jpn.org/prompt/1037.html',
'1038' => 'https://nanyo-city.jpn.org/prompt/1038.html',
'1039' => 'https://nanyo-city.jpn.org/prompt/1039.html',
'1040' => 'https://nanyo-city.jpn.org/prompt/1040.html',
'1041' => 'https://nanyo-city.jpn.org/prompt/1041.html',
'1042' => 'https://nanyo-city.jpn.org/prompt/1042.html',
'1043' => 'https://nanyo-city.jpn.org/prompt/1043.html',
'1044' => 'https://nanyo-city.jpn.org/prompt/1044.html',
'1045' => 'https://nanyo-city.jpn.org/prompt/1045.html',
'1046' => 'https://nanyo-city.jpn.org/prompt/1046.html',
'1047' => 'https://nanyo-city.jpn.org/prompt/1047.html',
'1048' => 'https://nanyo-city.jpn.org/prompt/1048.html',
'1049' => 'https://nanyo-city.jpn.org/prompt/1049.html',
'1050' => 'https://nanyo-city.jpn.org/prompt/1050.html',
'1051' => 'https://nanyo-city.jpn.org/prompt/1051.html',
'1052' => 'https://nanyo-city.jpn.org/prompt/1052.html',
'1053' => 'https://nanyo-city.jpn.org/prompt/1053.html',
'1054' => 'https://nanyo-city.jpn.org/prompt/1054.html',
'1055' => 'https://nanyo-city.jpn.org/prompt/1055.html',
'1056' => 'https://nanyo-city.jpn.org/prompt/1056.html',
'1057' => 'https://nanyo-city.jpn.org/prompt/1057.html',
'1058' => 'https://nanyo-city.jpn.org/prompt/1058.html',
'1059' => 'https://nanyo-city.jpn.org/prompt/1059.html',
'1060' => 'https://nanyo-city.jpn.org/prompt/1060.html',
'1061' => 'https://nanyo-city.jpn.org/prompt/1061.html',
'1062' => 'https://nanyo-city.jpn.org/prompt/1062.html',
'1063' => 'https://nanyo-city.jpn.org/prompt/1063.html',
'1064' => 'https://nanyo-city.jpn.org/prompt/1064.html',
'1065' => 'https://nanyo-city.jpn.org/prompt/1065.html',
'1066' => 'https://nanyo-city.jpn.org/prompt/1066.html',
'1067' => 'https://nanyo-city.jpn.org/prompt/1067.html',
'1068' => 'https://nanyo-city.jpn.org/prompt/1068.html',
'1069' => 'https://nanyo-city.jpn.org/prompt/1069.html',
'1070' => 'https://nanyo-city.jpn.org/prompt/1070.html',
'1071' => 'https://nanyo-city.jpn.org/prompt/1071.html',
'1072' => 'https://nanyo-city.jpn.org/prompt/1072.html',
'1073' => 'https://nanyo-city.jpn.org/prompt/1073.html',
'1074' => 'https://nanyo-city.jpn.org/prompt/1074.html',
'1075' => 'https://nanyo-city.jpn.org/prompt/1075.html',
'1076' => 'https://nanyo-city.jpn.org/prompt/1076.html',
'1077' => 'https://nanyo-city.jpn.org/prompt/1077.html',
'1078' => 'https://nanyo-city.jpn.org/prompt/1078.html',
'1079' => 'https://nanyo-city.jpn.org/prompt/1079.html',
'1080' => 'https://nanyo-city.jpn.org/prompt/1080.html',
'1081' => 'https://nanyo-city.jpn.org/prompt/1081.html',
'1082' => 'https://nanyo-city.jpn.org/prompt/1082.html',
'1083' => 'https://nanyo-city.jpn.org/prompt/1083.html',
'1084' => 'https://nanyo-city.jpn.org/prompt/1084.html',
'1085' => 'https://nanyo-city.jpn.org/prompt/1085.html',
'1086' => 'https://nanyo-city.jpn.org/prompt/1086.html',
'1087' => 'https://nanyo-city.jpn.org/prompt/1087.html',
'1088' => 'https://nanyo-city.jpn.org/prompt/1088.html',
'1089' => 'https://nanyo-city.jpn.org/prompt/1089.html',
'1090' => 'https://nanyo-city.jpn.org/prompt/1090.html',
'1091' => 'https://nanyo-city.jpn.org/prompt/1091.html',
'1092' => 'https://nanyo-city.jpn.org/prompt/1092.html',
'1093' => 'https://nanyo-city.jpn.org/prompt/1093.html',
'1094' => 'https://nanyo-city.jpn.org/prompt/1094.html',
'1095' => 'https://nanyo-city.jpn.org/prompt/1095.html',
'1096' => 'https://nanyo-city.jpn.org/prompt/1096.html',
'1097' => 'https://nanyo-city.jpn.org/prompt/1097.html',
'1098' => 'https://nanyo-city.jpn.org/prompt/1098.html',
'1099' => 'https://nanyo-city.jpn.org/prompt/1099.html',
'1100' => 'https://nanyo-city.jpn.org/prompt/1100.html',
'1101' => 'https://nanyo-city.jpn.org/prompt/1101.html',
'1102' => 'https://nanyo-city.jpn.org/prompt/1102.html',
'1103' => 'https://nanyo-city.jpn.org/prompt/1103.html',
'1104' => 'https://nanyo-city.jpn.org/prompt/1104.html',
'1105' => 'https://nanyo-city.jpn.org/prompt/1105.html',
'1106' => 'https://nanyo-city.jpn.org/prompt/1106.html',
'1107' => 'https://nanyo-city.jpn.org/prompt/1107.html',
'1108' => 'https://nanyo-city.jpn.org/prompt/1108.html',
'1109' => 'https://nanyo-city.jpn.org/prompt/1109.html',
'1110' => 'https://nanyo-city.jpn.org/prompt/1110.html',
'1111' => 'https://nanyo-city.jpn.org/prompt/1111.html',
'1112' => 'https://nanyo-city.jpn.org/prompt/1112.html',
'1113' => 'https://nanyo-city.jpn.org/prompt/1113.html',
'1114' => 'https://nanyo-city.jpn.org/prompt/1114.html',
'1115' => 'https://nanyo-city.jpn.org/prompt/1115.html',
'1116' => 'https://nanyo-city.jpn.org/prompt/1116.html',
'1117' => 'https://nanyo-city.jpn.org/prompt/1117.html',
'1118' => 'https://nanyo-city.jpn.org/prompt/1118.html',
'1119' => 'https://nanyo-city.jpn.org/prompt/1119.html',
'1120' => 'https://nanyo-city.jpn.org/prompt/1120.html',
'1121' => 'https://nanyo-city.jpn.org/prompt/1121.html',
'1122' => 'https://nanyo-city.jpn.org/prompt/1122.html',
'1123' => 'https://nanyo-city.jpn.org/prompt/1123.html',
'1124' => 'https://nanyo-city.jpn.org/prompt/1124.html',
'1125' => 'https://nanyo-city.jpn.org/prompt/1125.html',
'1126' => 'https://nanyo-city.jpn.org/prompt/1126.html',
'1127' => 'https://nanyo-city.jpn.org/prompt/1127.html',
'1128' => 'https://nanyo-city.jpn.org/prompt/1128.html',
'1129' => 'https://nanyo-city.jpn.org/prompt/1129.html',
'1130' => 'https://nanyo-city.jpn.org/prompt/1130.html',
'1131' => 'https://nanyo-city.jpn.org/prompt/1131.html',
'1132' => 'https://nanyo-city.jpn.org/prompt/1132.html',
'1133' => 'https://nanyo-city.jpn.org/prompt/1133.html',
'1134' => 'https://nanyo-city.jpn.org/prompt/1134.html',
'1135' => 'https://nanyo-city.jpn.org/prompt/1135.html',
'1136' => 'https://nanyo-city.jpn.org/prompt/1136.html',
'1137' => 'https://nanyo-city.jpn.org/prompt/1137.html',
'1138' => 'https://nanyo-city.jpn.org/prompt/1138.html',
'1139' => 'https://nanyo-city.jpn.org/prompt/1139.html',
'1140' => 'https://nanyo-city.jpn.org/prompt/1140.html',
'1141' => 'https://nanyo-city.jpn.org/prompt/1141.html',
'1142' => 'https://nanyo-city.jpn.org/prompt/1142.html',
'1143' => 'https://nanyo-city.jpn.org/prompt/1143.html',
'1144' => 'https://nanyo-city.jpn.org/prompt/1144.html',
'1145' => 'https://nanyo-city.jpn.org/prompt/1145.html',
'1146' => 'https://nanyo-city.jpn.org/prompt/1146.html',
'1147' => 'https://nanyo-city.jpn.org/prompt/1147.html',
'1148' => 'https://nanyo-city.jpn.org/prompt/1148.html',
'1149' => 'https://nanyo-city.jpn.org/prompt/1149.html',
'1150' => 'https://nanyo-city.jpn.org/prompt/1150.html',
'1151' => 'https://nanyo-city.jpn.org/prompt/1151.html',
'1152' => 'https://nanyo-city.jpn.org/prompt/1152.html',
'1153' => 'https://nanyo-city.jpn.org/prompt/1153.html',
'1154' => 'https://nanyo-city.jpn.org/prompt/1154.html',
'1155' => 'https://nanyo-city.jpn.org/prompt/1155.html',
'1156' => 'https://nanyo-city.jpn.org/prompt/1156.html',
'1157' => 'https://nanyo-city.jpn.org/prompt/1157.html',
'1158' => 'https://nanyo-city.jpn.org/prompt/1158.html',
'1159' => 'https://nanyo-city.jpn.org/prompt/1159.html',
'1160' => 'https://nanyo-city.jpn.org/prompt/1160.html',
'1161' => 'https://nanyo-city.jpn.org/prompt/1161.html',
'1162' => 'https://nanyo-city.jpn.org/prompt/1162.html',
'1163' => 'https://nanyo-city.jpn.org/prompt/1163.html',
'1164' => 'https://nanyo-city.jpn.org/prompt/1164.html',
'1165' => 'https://nanyo-city.jpn.org/prompt/1165.html',
'1166' => 'https://nanyo-city.jpn.org/prompt/1166.html',
'1167' => 'https://nanyo-city.jpn.org/prompt/1167.html',
'1168' => 'https://nanyo-city.jpn.org/prompt/1168.html',
'1169' => 'https://nanyo-city.jpn.org/prompt/1169.html',
'1170' => 'https://nanyo-city.jpn.org/prompt/1170.html',
'1171' => 'https://nanyo-city.jpn.org/prompt/1171.html',
'1172' => 'https://nanyo-city.jpn.org/prompt/1172.html',
'1173' => 'https://nanyo-city.jpn.org/prompt/1173.html',
'1174' => 'https://nanyo-city.jpn.org/prompt/1174.html',
'1175' => 'https://nanyo-city.jpn.org/prompt/1175.html',
'1176' => 'https://nanyo-city.jpn.org/prompt/1176.html',
'1177' => 'https://nanyo-city.jpn.org/prompt/1177.html',
'1178' => 'https://nanyo-city.jpn.org/prompt/1178.html',
'1179' => 'https://nanyo-city.jpn.org/prompt/1179.html',
'1180' => 'https://nanyo-city.jpn.org/prompt/1180.html',
'1181' => 'https://nanyo-city.jpn.org/prompt/1181.html',
'1182' => 'https://nanyo-city.jpn.org/prompt/1182.html',
'1183' => 'https://nanyo-city.jpn.org/prompt/1183.html',
'1184' => 'https://nanyo-city.jpn.org/prompt/1184.html',
'1185' => 'https://nanyo-city.jpn.org/prompt/1185.html',
'1186' => 'https://nanyo-city.jpn.org/prompt/1186.html',
'1187' => 'https://nanyo-city.jpn.org/prompt/1187.html',
'1188' => 'https://nanyo-city.jpn.org/prompt/1188.html',
'1189' => 'https://nanyo-city.jpn.org/prompt/1189.html',
'1190' => 'https://nanyo-city.jpn.org/prompt/1190.html',
'1191' => 'https://nanyo-city.jpn.org/prompt/1191.html',
'1192' => 'https://nanyo-city.jpn.org/prompt/1192.html',
'1193' => 'https://nanyo-city.jpn.org/prompt/1193.html',
'1194' => 'https://nanyo-city.jpn.org/prompt/1194.html',
'1195' => 'https://nanyo-city.jpn.org/prompt/1195.html',
'1196' => 'https://nanyo-city.jpn.org/prompt/1196.html',
'1197' => 'https://nanyo-city.jpn.org/prompt/1197.html',
'1198' => 'https://nanyo-city.jpn.org/prompt/1198.html',
'1199' => 'https://nanyo-city.jpn.org/prompt/1199.html',
'1200' => 'https://nanyo-city.jpn.org/prompt/1200.html',
'1201' => 'https://nanyo-city.jpn.org/prompt/1201.html',
'1202' => 'https://nanyo-city.jpn.org/prompt/1202.html',
'1203' => 'https://nanyo-city.jpn.org/prompt/1203.html',
'1204' => 'https://nanyo-city.jpn.org/prompt/1204.html',
'1205' => 'https://nanyo-city.jpn.org/prompt/1205.html',
'1206' => 'https://nanyo-city.jpn.org/prompt/1206.html',
'1207' => 'https://nanyo-city.jpn.org/prompt/1207.html',
'1208' => 'https://nanyo-city.jpn.org/prompt/1208.html',
'1209' => 'https://nanyo-city.jpn.org/prompt/1209.html',
'1210' => 'https://nanyo-city.jpn.org/prompt/1210.html',
'1211' => 'https://nanyo-city.jpn.org/prompt/1211.html',
'1212' => 'https://nanyo-city.jpn.org/prompt/1212.html',
'1213' => 'https://nanyo-city.jpn.org/prompt/1213.html',
'1214' => 'https://nanyo-city.jpn.org/prompt/1214.html',
'1215' => 'https://nanyo-city.jpn.org/prompt/1215.html',
'1216' => 'https://nanyo-city.jpn.org/prompt/1216.html',
'1217' => 'https://nanyo-city.jpn.org/prompt/1217.html',
'1218' => 'https://nanyo-city.jpn.org/prompt/1218.html',
'1219' => 'https://nanyo-city.jpn.org/prompt/1219.html',
'1220' => 'https://nanyo-city.jpn.org/prompt/1220.html',
'1221' => 'https://nanyo-city.jpn.org/prompt/1221.html',
'1222' => 'https://nanyo-city.jpn.org/prompt/1222.html',
'1223' => 'https://nanyo-city.jpn.org/prompt/1223.html',
'1224' => 'https://nanyo-city.jpn.org/prompt/1224.html',
'1225' => 'https://nanyo-city.jpn.org/prompt/1225.html',
'1226' => 'https://nanyo-city.jpn.org/prompt/1226.html',
'1227' => 'https://nanyo-city.jpn.org/prompt/1227.html',
'1228' => 'https://nanyo-city.jpn.org/prompt/1228.html',
'1229' => 'https://nanyo-city.jpn.org/prompt/1229.html',
'1230' => 'https://nanyo-city.jpn.org/prompt/1230.html',
'1231' => 'https://nanyo-city.jpn.org/prompt/1231.html',
'1232' => 'https://nanyo-city.jpn.org/prompt/1232.html',
'1233' => 'https://nanyo-city.jpn.org/prompt/1233.html',
'1234' => 'https://nanyo-city.jpn.org/prompt/1234.html',
'1235' => 'https://nanyo-city.jpn.org/prompt/1235.html',
'1236' => 'https://nanyo-city.jpn.org/prompt/1236.html',
'1237' => 'https://nanyo-city.jpn.org/prompt/1237.html',
'1238' => 'https://nanyo-city.jpn.org/prompt/1238.html',
'1239' => 'https://nanyo-city.jpn.org/prompt/1239.html',
'1240' => 'https://nanyo-city.jpn.org/prompt/1240.html',
'1241' => 'https://nanyo-city.jpn.org/prompt/1241.html',
'1242' => 'https://nanyo-city.jpn.org/prompt/1242.html',
'1243' => 'https://nanyo-city.jpn.org/prompt/1243.html',
'1244' => 'https://nanyo-city.jpn.org/prompt/1244.html',
'1245' => 'https://nanyo-city.jpn.org/prompt/1245.html',
'1246' => 'https://nanyo-city.jpn.org/prompt/1246.html',
'1247' => 'https://nanyo-city.jpn.org/prompt/1247.html',
'1248' => 'https://nanyo-city.jpn.org/prompt/1248.html',
'1249' => 'https://nanyo-city.jpn.org/prompt/1249.html',
'1250' => 'https://nanyo-city.jpn.org/prompt/1250.html',
'1251' => 'https://nanyo-city.jpn.org/prompt/1251.html',
'1252' => 'https://nanyo-city.jpn.org/prompt/1252.html',
'1253' => 'https://nanyo-city.jpn.org/prompt/1253.html',
'1254' => 'https://nanyo-city.jpn.org/prompt/1254.html',
'1255' => 'https://nanyo-city.jpn.org/prompt/1255.html',
'1256' => 'https://nanyo-city.jpn.org/prompt/1256.html',
'1257' => 'https://nanyo-city.jpn.org/prompt/1257.html',
'1258' => 'https://nanyo-city.jpn.org/prompt/1258.html',
'1259' => 'https://nanyo-city.jpn.org/prompt/1259.html',
'1260' => 'https://nanyo-city.jpn.org/prompt/1260.html',
'1261' => 'https://nanyo-city.jpn.org/prompt/1261.html',
'1262' => 'https://nanyo-city.jpn.org/prompt/1262.html',
'1263' => 'https://nanyo-city.jpn.org/prompt/1263.html',
'1264' => 'https://nanyo-city.jpn.org/prompt/1264.html',
'1265' => 'https://nanyo-city.jpn.org/prompt/1265.html',
'1266' => 'https://nanyo-city.jpn.org/prompt/1266.html',
'1267' => 'https://nanyo-city.jpn.org/prompt/1267.html',
'1268' => 'https://nanyo-city.jpn.org/prompt/1268.html',
'1269' => 'https://nanyo-city.jpn.org/prompt/1269.html',
'1270' => 'https://nanyo-city.jpn.org/prompt/1270.html',
'1271' => 'https://nanyo-city.jpn.org/prompt/1271.html',
'1272' => 'https://nanyo-city.jpn.org/prompt/1272.html',
'1273' => 'https://nanyo-city.jpn.org/prompt/1273.html',
'1274' => 'https://nanyo-city.jpn.org/prompt/1274.html',
'1275' => 'https://nanyo-city.jpn.org/prompt/1275.html',
'1276' => 'https://nanyo-city.jpn.org/prompt/1276.html',
'1277' => 'https://nanyo-city.jpn.org/prompt/1277.html',
'1278' => 'https://nanyo-city.jpn.org/prompt/1278.html',
'1279' => 'https://nanyo-city.jpn.org/prompt/1279.html',
'1280' => 'https://nanyo-city.jpn.org/prompt/1280.html',
'1281' => 'https://nanyo-city.jpn.org/prompt/1281.html',
'1282' => 'https://nanyo-city.jpn.org/prompt/1282.html',
'1283' => 'https://nanyo-city.jpn.org/prompt/1283.html',
'1284' => 'https://nanyo-city.jpn.org/prompt/1284.html',
'1285' => 'https://nanyo-city.jpn.org/prompt/1285.html',
'1286' => 'https://nanyo-city.jpn.org/prompt/1286.html',
'1287' => 'https://nanyo-city.jpn.org/prompt/1287.html',
'1288' => 'https://nanyo-city.jpn.org/prompt/1288.html',
'1289' => 'https://nanyo-city.jpn.org/prompt/1289.html',
'1290' => 'https://nanyo-city.jpn.org/prompt/1290.html',
'1291' => 'https://nanyo-city.jpn.org/prompt/1291.html',
'1292' => 'https://nanyo-city.jpn.org/prompt/1292.html',
'1293' => 'https://nanyo-city.jpn.org/prompt/1293.html',
'1294' => 'https://nanyo-city.jpn.org/prompt/1294.html',
'1295' => 'https://nanyo-city.jpn.org/prompt/1295.html',
'1296' => 'https://nanyo-city.jpn.org/prompt/1296.html',
'1297' => 'https://nanyo-city.jpn.org/prompt/1297.html',
'1298' => 'https://nanyo-city.jpn.org/prompt/1298.html',
'1299' => 'https://nanyo-city.jpn.org/prompt/1299.html',
'1300' => 'https://nanyo-city.jpn.org/prompt/1300.html',
'1301' => 'https://nanyo-city.jpn.org/prompt/1301.html',
'1302' => 'https://nanyo-city.jpn.org/prompt/1302.html',
'1303' => 'https://nanyo-city.jpn.org/prompt/1303.html',
'1304' => 'https://nanyo-city.jpn.org/prompt/1304.html',
'1305' => 'https://nanyo-city.jpn.org/prompt/1305.html',
'1306' => 'https://nanyo-city.jpn.org/prompt/1306.html',
'1307' => 'https://nanyo-city.jpn.org/prompt/1307.html',
'1308' => 'https://nanyo-city.jpn.org/prompt/1308.html',
'1309' => 'https://nanyo-city.jpn.org/prompt/1309.html',
'1310' => 'https://nanyo-city.jpn.org/prompt/1310.html',
'1311' => 'https://nanyo-city.jpn.org/prompt/1311.html',
'1312' => 'https://nanyo-city.jpn.org/prompt/1312.html',
'1313' => 'https://nanyo-city.jpn.org/prompt/1313.html',
'1314' => 'https://nanyo-city.jpn.org/prompt/1314.html',
'1315' => 'https://nanyo-city.jpn.org/prompt/1315.html',
'1316' => 'https://nanyo-city.jpn.org/prompt/1316.html',
'1317' => 'https://nanyo-city.jpn.org/prompt/1317.html',
'1318' => 'https://nanyo-city.jpn.org/prompt/1318.html',
'1319' => 'https://nanyo-city.jpn.org/prompt/1319.html',
'1320' => 'https://nanyo-city.jpn.org/prompt/1320.html',
'1321' => 'https://nanyo-city.jpn.org/prompt/1321.html',
'1322' => 'https://nanyo-city.jpn.org/prompt/1322.html',
'1323' => 'https://nanyo-city.jpn.org/prompt/1323.html',
'1324' => 'https://nanyo-city.jpn.org/prompt/1324.html',
'1325' => 'https://nanyo-city.jpn.org/prompt/1325.html',
'1326' => 'https://nanyo-city.jpn.org/prompt/1326.html',
'1327' => 'https://nanyo-city.jpn.org/prompt/1327.html',
'1328' => 'https://nanyo-city.jpn.org/prompt/1328.html',
'1329' => 'https://nanyo-city.jpn.org/prompt/1329.html',
'1330' => 'https://nanyo-city.jpn.org/prompt/1330.html',
'1331' => 'https://nanyo-city.jpn.org/prompt/1331.html',
'1332' => 'https://nanyo-city.jpn.org/prompt/1332.html',
'1333' => 'https://nanyo-city.jpn.org/prompt/1333.html',
'1334' => 'https://nanyo-city.jpn.org/prompt/1334.html',
'1335' => 'https://nanyo-city.jpn.org/prompt/1335.html',
'1336' => 'https://nanyo-city.jpn.org/prompt/1336.html',
'1337' => 'https://nanyo-city.jpn.org/prompt/1337.html',
'1338' => 'https://nanyo-city.jpn.org/prompt/1338.html',
'1339' => 'https://nanyo-city.jpn.org/prompt/1339.html',
'1340' => 'https://nanyo-city.jpn.org/prompt/1340.html',
'1341' => 'https://nanyo-city.jpn.org/prompt/1341.html',
'1342' => 'https://nanyo-city.jpn.org/prompt/1342.html',
'1343' => 'https://nanyo-city.jpn.org/prompt/1343.html',
'1344' => 'https://nanyo-city.jpn.org/prompt/1344.html',
'1345' => 'https://nanyo-city.jpn.org/prompt/1345.html',
'1346' => 'https://nanyo-city.jpn.org/prompt/1346.html',
'1347' => 'https://nanyo-city.jpn.org/prompt/1347.html',
'1348' => 'https://nanyo-city.jpn.org/prompt/1348.html',
'1349' => 'https://nanyo-city.jpn.org/prompt/1349.html',
'1350' => 'https://nanyo-city.jpn.org/prompt/1350.html',
'1351' => 'https://nanyo-city.jpn.org/prompt/1351.html',
'1352' => 'https://nanyo-city.jpn.org/prompt/1352.html',
'1353' => 'https://nanyo-city.jpn.org/prompt/1353.html',
'1354' => 'https://nanyo-city.jpn.org/prompt/1354.html',
'1355' => 'https://nanyo-city.jpn.org/prompt/1355.html',
'1356' => 'https://nanyo-city.jpn.org/prompt/1356.html',
'1357' => 'https://nanyo-city.jpn.org/prompt/1357.html',
'1358' => 'https://nanyo-city.jpn.org/prompt/1358.html',
'1359' => 'https://nanyo-city.jpn.org/prompt/1359.html',
'1360' => 'https://nanyo-city.jpn.org/prompt/1360.html',
'1361' => 'https://nanyo-city.jpn.org/prompt/1361.html',
'1362' => 'https://nanyo-city.jpn.org/prompt/1362.html',
'1363' => 'https://nanyo-city.jpn.org/prompt/1363.html',
'1364' => 'https://nanyo-city.jpn.org/prompt/1364.html',
'1365' => 'https://nanyo-city.jpn.org/prompt/1365.html',
'1366' => 'https://nanyo-city.jpn.org/prompt/1366.html',
'1367' => 'https://nanyo-city.jpn.org/prompt/1367.html',
'1368' => 'https://nanyo-city.jpn.org/prompt/1368.html',
'1369' => 'https://nanyo-city.jpn.org/prompt/1369.html',
'1370' => 'https://nanyo-city.jpn.org/prompt/1370.html',
'1371' => 'https://nanyo-city.jpn.org/prompt/1371.html',
'1372' => 'https://nanyo-city.jpn.org/prompt/1372.html',
'1373' => 'https://nanyo-city.jpn.org/prompt/1373.html',
'1374' => 'https://nanyo-city.jpn.org/prompt/1374.html',
'1375' => 'https://nanyo-city.jpn.org/prompt/1375.html',
'1376' => 'https://nanyo-city.jpn.org/prompt/1376.html',
'1377' => 'https://nanyo-city.jpn.org/prompt/1377.html',
'1378' => 'https://nanyo-city.jpn.org/prompt/1378.html',
'1379' => 'https://nanyo-city.jpn.org/prompt/1379.html',
'1380' => 'https://nanyo-city.jpn.org/prompt/1380.html',
'1381' => 'https://nanyo-city.jpn.org/prompt/1381.html',
'1382' => 'https://nanyo-city.jpn.org/prompt/1382.html',
'1383' => 'https://nanyo-city.jpn.org/prompt/1383.html',
'1384' => 'https://nanyo-city.jpn.org/prompt/1384.html',
'1385' => 'https://nanyo-city.jpn.org/prompt/1385.html',
'1386' => 'https://nanyo-city.jpn.org/prompt/1386.html',
'1387' => 'https://nanyo-city.jpn.org/prompt/1387.html',
'1388' => 'https://nanyo-city.jpn.org/prompt/1388.html',
'1389' => 'https://nanyo-city.jpn.org/prompt/1389.html',
'1390' => 'https://nanyo-city.jpn.org/prompt/1390.html',
'1391' => 'https://nanyo-city.jpn.org/prompt/1391.html',
'1392' => 'https://nanyo-city.jpn.org/prompt/1392.html',
'1393' => 'https://nanyo-city.jpn.org/prompt/1393.html',
'1394' => 'https://nanyo-city.jpn.org/prompt/1394.html',
'1395' => 'https://nanyo-city.jpn.org/prompt/1395.html',
'1396' => 'https://nanyo-city.jpn.org/prompt/1396.html',
'1397' => 'https://nanyo-city.jpn.org/prompt/1397.html',
'1398' => 'https://nanyo-city.jpn.org/prompt/1398.html',
'1399' => 'https://nanyo-city.jpn.org/prompt/1399.html',
'1400' => 'https://nanyo-city.jpn.org/prompt/1400.html',
'1401' => 'https://nanyo-city.jpn.org/prompt/1401.html',
'1402' => 'https://nanyo-city.jpn.org/prompt/1402.html',
'1403' => 'https://nanyo-city.jpn.org/prompt/1403.html',
'1404' => 'https://nanyo-city.jpn.org/prompt/1404.html',
'1405' => 'https://nanyo-city.jpn.org/prompt/1405.html',
'1406' => 'https://nanyo-city.jpn.org/prompt/1406.html',
'1407' => 'https://nanyo-city.jpn.org/prompt/1407.html',
'1408' => 'https://nanyo-city.jpn.org/prompt/1408.html',
'1409' => 'https://nanyo-city.jpn.org/prompt/1409.html',
'1410' => 'https://nanyo-city.jpn.org/prompt/1410.html',
'1411' => 'https://nanyo-city.jpn.org/prompt/1411.html',
'1412' => 'https://nanyo-city.jpn.org/prompt/1412.html',
'1413' => 'https://nanyo-city.jpn.org/prompt/1413.html',
'1414' => 'https://nanyo-city.jpn.org/prompt/1414.html',
'1415' => 'https://nanyo-city.jpn.org/prompt/1415.html',
'1416' => 'https://nanyo-city.jpn.org/prompt/1416.html',
'1417' => 'https://nanyo-city.jpn.org/prompt/1417.html',
'1418' => 'https://nanyo-city.jpn.org/prompt/1418.html',
'1419' => 'https://nanyo-city.jpn.org/prompt/1419.html',
'1420' => 'https://nanyo-city.jpn.org/prompt/1420.html',
'1421' => 'https://nanyo-city.jpn.org/prompt/1421.html',
'1422' => 'https://nanyo-city.jpn.org/prompt/1422.html',
'1423' => 'https://nanyo-city.jpn.org/prompt/1423.html',
'1424' => 'https://nanyo-city.jpn.org/prompt/1424.html',
'1425' => 'https://nanyo-city.jpn.org/prompt/1425.html',
'1426' => 'https://nanyo-city.jpn.org/prompt/1426.html',
'1427' => 'https://nanyo-city.jpn.org/prompt/1427.html',
'1428' => 'https://nanyo-city.jpn.org/prompt/1428.html',
'1429' => 'https://nanyo-city.jpn.org/prompt/1429.html',
'1430' => 'https://nanyo-city.jpn.org/prompt/1430.html',
'1431' => 'https://nanyo-city.jpn.org/prompt/1431.html',
'1432' => 'https://nanyo-city.jpn.org/prompt/1432.html',
'1433' => 'https://nanyo-city.jpn.org/prompt/1433.html',
'1434' => 'https://nanyo-city.jpn.org/prompt/1434.html',
'1435' => 'https://nanyo-city.jpn.org/prompt/1435.html',
'1436' => 'https://nanyo-city.jpn.org/prompt/1436.html',
'1437' => 'https://nanyo-city.jpn.org/prompt/1437.html',
'1438' => 'https://nanyo-city.jpn.org/prompt/1438.html',
'1439' => 'https://nanyo-city.jpn.org/prompt/1439.html',
'1440' => 'https://nanyo-city.jpn.org/prompt/1440.html',
'1441' => 'https://nanyo-city.jpn.org/prompt/1441.html',
'1442' => 'https://nanyo-city.jpn.org/prompt/1442.html',
'1443' => 'https://nanyo-city.jpn.org/prompt/1443.html',
'1444' => 'https://nanyo-city.jpn.org/prompt/1444.html',
'1445' => 'https://nanyo-city.jpn.org/prompt/1445.html',
'1446' => 'https://nanyo-city.jpn.org/prompt/1446.html',
'1447' => 'https://nanyo-city.jpn.org/prompt/1447.html',
'1448' => 'https://nanyo-city.jpn.org/prompt/1448.html',
'1449' => 'https://nanyo-city.jpn.org/prompt/1449.html',
'1450' => 'https://nanyo-city.jpn.org/prompt/1450.html',
'1451' => 'https://nanyo-city.jpn.org/prompt/1451.html',
'1452' => 'https://nanyo-city.jpn.org/prompt/1452.html',
'1453' => 'https://nanyo-city.jpn.org/prompt/1453.html',
'1454' => 'https://nanyo-city.jpn.org/prompt/1454.html',
'1455' => 'https://nanyo-city.jpn.org/prompt/1455.html',
'1456' => 'https://nanyo-city.jpn.org/prompt/1456.html',
'1457' => 'https://nanyo-city.jpn.org/prompt/1457.html',
'1458' => 'https://nanyo-city.jpn.org/prompt/1458.html',
'1459' => 'https://nanyo-city.jpn.org/prompt/1459.html',
'1460' => 'https://nanyo-city.jpn.org/prompt/1460.html',
'1461' => 'https://nanyo-city.jpn.org/prompt/1461.html',
'1462' => 'https://nanyo-city.jpn.org/prompt/1462.html',
'1463' => 'https://nanyo-city.jpn.org/prompt/1463.html',
'1464' => 'https://nanyo-city.jpn.org/prompt/1464.html',
'1465' => 'https://nanyo-city.jpn.org/prompt/1465.html',
'1466' => 'https://nanyo-city.jpn.org/prompt/1466.html',
'1467' => 'https://nanyo-city.jpn.org/prompt/1467.html',
'1468' => 'https://nanyo-city.jpn.org/prompt/1468.html',
'1469' => 'https://nanyo-city.jpn.org/prompt/1469.html',
'1470' => 'https://nanyo-city.jpn.org/prompt/1470.html',
'1471' => 'https://nanyo-city.jpn.org/prompt/1471.html',
'1472' => 'https://nanyo-city.jpn.org/prompt/1472.html',
'1473' => 'https://nanyo-city.jpn.org/prompt/1473.html',
'1474' => 'https://nanyo-city.jpn.org/prompt/1474.html',
'1475' => 'https://nanyo-city.jpn.org/prompt/1475.html',
'1476' => 'https://nanyo-city.jpn.org/prompt/1476.html',
'1477' => 'https://nanyo-city.jpn.org/prompt/1477.html',
'1478' => 'https://nanyo-city.jpn.org/prompt/1478.html',
'1479' => 'https://nanyo-city.jpn.org/prompt/1479.html',
'1480' => 'https://nanyo-city.jpn.org/prompt/1480.html',
'1481' => 'https://nanyo-city.jpn.org/prompt/1481.html',
'1482' => 'https://nanyo-city.jpn.org/prompt/1482.html',
'1483' => 'https://nanyo-city.jpn.org/prompt/1483.html',
'1484' => 'https://nanyo-city.jpn.org/prompt/1484.html',
'1485' => 'https://nanyo-city.jpn.org/prompt/1485.html',
'1486' => 'https://nanyo-city.jpn.org/prompt/1486.html',
'1487' => 'https://nanyo-city.jpn.org/prompt/1487.html',
'1488' => 'https://nanyo-city.jpn.org/prompt/1488.html',
'1489' => 'https://nanyo-city.jpn.org/prompt/1489.html',
'1490' => 'https://nanyo-city.jpn.org/prompt/1490.html',
'1491' => 'https://nanyo-city.jpn.org/prompt/1491.html',
'1492' => 'https://nanyo-city.jpn.org/prompt/1492.html',
'1493' => 'https://nanyo-city.jpn.org/prompt/1493.html',
'1494' => 'https://nanyo-city.jpn.org/prompt/1494.html',
'1495' => 'https://nanyo-city.jpn.org/prompt/1495.html',
'1496' => 'https://nanyo-city.jpn.org/prompt/1496.html',
'1497' => 'https://nanyo-city.jpn.org/prompt/1497.html',
'1498' => 'https://nanyo-city.jpn.org/prompt/1498.html',
'1499' => 'https://nanyo-city.jpn.org/prompt/1499.html',
'1500' => 'https://nanyo-city.jpn.org/prompt/1500.html',
);


//カウントを表示するページの文字コード
//Shift-jisは「SJIS」、EUC-JPは「EUC-JP」と指定してください。デフォルトはUTF-8。
$encodingType = 'UTF-8';


//ダウンロード履歴閲覧のための認証用ID、パスワード　※必ず変更して下さい！
//半角英数字のみ
$userid   = 'admin';   // ユーザーID
$password = '1397';   // パスワード

//-----------------------------　設定箇所（END）　-------------------------------


//-----------------------------以下変更不可（日本語部、htmlは編集可）---------------------------------

$base_day = date("Y/m/d"); //日付の取得
$yesterday = date("Y/m/d",strtotime("-1day")); //日付の取得

//総ダウンロード数格納データファイルのパス（変更不可）
$data_log_dir = 'data/';
foreach($download_url as $key => $val){
	$file_path[$key] = $data_log_dir."download_count_".$key.".log";
}
//パーミッションチェック
if(!is_writable($data_log_dir)){
  $permission_chk = 'dataディレクトリのパーミッションが正しくありません。パーミッションを777等（サーバによる）ファイル書き込み可能に変更ください';
}
if(!empty($permission_chk)){
	echo $permission_chk;exit();
}
$copyrights = '<a style="display:block;text-align:center;margin:15px 0;font-size:11px;color:#aaa;text-decoration:none" href="http://www.php-factory.net/" target="_blank">- PHP工房 -</a>';

//----------------------------------------------------------------------
//  ダウンロード数表示用処理 (START)
//----------------------------------------------------------------------
if(isset($_GET['dsp_count'])){
	header("Content-type: application/x-javascript");
	
	if(!preg_match("/^[0-9]+$/",$_GET['dsp_count'])){
	echo "document.write(\"パラメータが正しくありません。半角数字を指定して下さい。\")";exit();
	}
	  $dsp_count_no = $_GET['dsp_count'];
	  if(!file_exists($file_path[$dsp_count_no])){
		//ファイルが存在しない場合はデータを追加してファイル生成
		file_new_generate($file_path[$dsp_count_no]);
	  }
	  $line = file($file_path[$dsp_count_no]);
	  $total = 0;
	  $today_count = 0;	
	  $yesterday_count = 0;
	  foreach($line as $val){
		  $val_array = explode(',',$val);
		  $total += trim($val_array[1]);
		  if(strpos($val_array[0],$base_day) !== false){
			  $today_count = trim($val_array[1]);
		  }
		  if(strpos($val_array[0],$yesterday) !== false){
			  $yesterday_count = trim($val_array[1]);
		  }
	  }
	
	
	if(isset($_GET['day_dsp']) =='on'){
 //出力
$count_dsp = <<<EOF
document.write('<p class="download_count">総ダウンロード数：{$total}（<span class="count_today">Today:{$today_count}</span> <span class="count_yesterday">Yesterday:{$yesterday_count}</span>）</p>')
EOF;

	}else{
//出力
$count_dsp = <<<EOF
document.write('<p class="download_count">総ダウンロード数：{$total}</p>')
EOF;
	}
	//UTF-8以外であれば文字コード変更
	if($encodingType!='UTF-8') $count_dsp = mb_convert_encoding($count_dsp,"$encodingType",'UTF-8');
	echo $count_dsp;
	
	exit();
}
//----------------------------------------------------------------------
//  ダウンロード数表示用処理 (END)
//----------------------------------------------------------------------


//----------------------------------------------------------------------
//  ダウンロード数保存処理(START)
//----------------------------------------------------------------------

//パラメータ（id）を取得
if(isset($_GET['download'])){
	$file_id = $_GET['download'];
	//パラメータが配列数以下かor数字であるかのチェック
	if(!preg_match("/^[0-9]+$/",$file_id)){
		exit('パラメータの数値が間違っています。');
	}
	
	//$line = file($file_path[$file_id]);
	
	$fp = fopen($file_path[$file_id],"r+b");
	flock($fp,LOCK_EX);
	
	$line = array();
	while(($data = fgets($fp)) !== false ){
		$line[] = $data;
	}
	
	ftruncate($fp,0);
	rewind($fp);
	
	//日付が変わったら先頭の行に追記
	if(strpos($line[0],$base_day) === false){
		$write_line = $base_day.',1'."\n";
		fwrite($fp,$write_line);
	}
	
	foreach($line as $val){
		//当日の場合はカウントアップ
		if(strpos($val,$base_day) !== false){
			$val_array = explode(',',$val);
			$val_array[1] = rtrim($val_array[1],"\n") + 1;
			$val = $val_array[0].','.$val_array[1]."\n";
		}
		fwrite($fp,$val);
	}
	fflush($fp);
	flock($fp,LOCK_UN);
	fclose($fp);

			//----------------------------------------------------------------------
			//  ダウンロードリストに無いファイルを削除する(START)
			//----------------------------------------------------------------------
			$dh = opendir($data_log_dir);
			while(false !== ($fn = readdir($dh))){
				$exis_check = '';
				foreach($download_url as $key => $val){
					if($fn == "download_count_".$key.".log"){
						   $exis_check = 'Found';
						   break;
					}
				}
				if($exis_check == '' && $fn !== '.' && $fn !== '..' && !is_dir($data_log_dir.$fn)){
					//ファイル削除実行
					if(!empty($data_log_dir) && strpos($fn,'.log') !== false){
						@unlink($data_log_dir.$fn);
					}
				}
			}
			closedir($dh);
			//----------------------------------------------------------------------
			//  ダウンロードリストに無いファイルを削除する(END)
			//----------------------------------------------------------------------

//----------------------------------------------------------------------
//  ダウンロード数保存処理(END)
//----------------------------------------------------------------------

	//ダウンロードファイルへのリダイレクト実行 
	header("Location: {$download_url[$file_id]}");
	exit();
}
else{
	//exit('パラメータが間違っています。リンクはdownload=○と指定してください。○は数値（配列の番号）');	

//----------------------------------------------------------------------
//  ダウンロード履歴表示(START)
//----------------------------------------------------------------------

session_start();
if(isset($_GET['logout'])){
$_SESSION = array();
# セッションを破棄
session_destroy();
}
$login_error = '';
# セッション変数を初期化
if (!isset($_SESSION['auth'])) {
  $_SESSION['auth'] = FALSE;
}
if (isset($_POST['userid']) && isset($_POST['password'])){
    if ($_POST['userid'] === $userid &&
        $_POST['password'] === $password) {
      $oldSid = session_id();
      session_regenerate_id(TRUE);
      if (version_compare(PHP_VERSION, '5.1.0', '<')) {
        $path = session_save_path() != '' ? session_save_path() : '/tmp';
        $oldSessionFile = $path . '/sess_' . $oldSid;
        if (file_exists($oldSessionFile)) {
          unlink($oldSessionFile);
        }
      }
      $_SESSION['auth'] = TRUE;
    }
  if ($_SESSION['auth'] === FALSE) {
    $login_error = '<center><font color="red">ユーザーIDかパスワードに誤りがあります。</font></center>';
  }
}
if ($_SESSION['auth'] !== TRUE) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ダウンロード履歴管理画面</title>
</head>
<style type="text/css">
#login_form{
	width:500px;	
	margin:25px auto;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0px 7px #aaa;
    font-weight: normal;
    padding: 16px 16px 20px;
	color:#666;
	line-height:1.3;
	font-size:90%;
}
form .input {
    font-size: 20px;
    margin:2px 6px 10px 0;
    padding: 3px;
    width: 97%;
}
input[type="text"], input[type="password"], input[type="file"], input[type="button"], input[type="submit"], input[type="reset"] {
    background-color: #FFFFFF;
    border: 1px solid #999;
}
.button-primary {
    border: 1px solid #000;
    border-radius: 11px;
    cursor: pointer;
    font-size: 18px;
    padding: 3px 10px;
	width:450px;
	height:38px;
}
.Tac{text-align:center}
</style>
<body>
<?php if(isset($login_error)) echo $login_error;?>
 <div id="login_form">

 <p class="Tac">ダウンロード履歴を閲覧するにはログインする必要があります。<br />
   ID、パスワードを入力して下さい。<br />管理者以外の入場は固くお断りします。IPアドレスを記録しております。</p>
<form action="<?php echo $file_name; ?>?mode=download" method="post">
<label for="userid">ユーザーID</label>
<input class="input" type="text" name="userid" id="userid" value="" style="ime-mode:disabled" />
<label for="password">パスワード</label>      
<input class="input" type="password" name="password" id="password" value="" size="30" />
<p class="Tac">
<input class="button-primary" type="submit" name="login_submit" value="　ログイン　" />
</p>
</form>
</div>
</body>
</html>
<?php
	exit();
	}else{

?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="robots" content="noindex,nofollow">
<title>ダウンロード履歴</title>
<style type="text/css">
<!--
p{
	font-size:90%;
}
h1{
	font-size:16px;
	color:#39F;
}
h2{
	font-size:13px;
	padding:10px 0 0;
	border-top:1px solid #999;
	color:#963;
}
table{
	border-collapse:collapse;
}
td,th{
	padding:5px 10px;
	border:1px solid #999;
	text-align:right;
	font-size:90%;
}
th{
	background:#F2FFE6;
	text-align:center;
	font-weight:normal;
}
-->
</style>
<h1>ダウンロード履歴</h1>
<p>※日付が歯抜け（無い）の場合はダウンロードが「0」ということになります。　【<a href="?logout=true">ログアウト</a>】</p>
<?php foreach($file_path as $key => $val){ ?>
<h2><?php echo 'ファイル：'.$download_url[$key];?></h2>
<table>
<tr>
<th>日付</th>
<td>ダウンロード数</td>
</tr>
<?php	  
$total_download = 0;
$line = file($val);
foreach($line as $line_val){
$line_array = explode(',',$line_val);
$total_download += $line_array[1];
?>	  
<tr>
<th><?php echo $line_array[0];?></th>
<td><?php echo $line_array[1];?></td>
</tr>
<?php }?>
<tr>
<th colspan="2">総ダウンロード数：<?php echo $total_download;?></th>
</tr>
</table>
<?php }
if(!empty($copyrights)) echo $copyrights;

	}
//----------------------------------------------------------------------
//  ダウンロード履歴表示(END)
//----------------------------------------------------------------------
}
?>

<?php
//----------------------------------------------------------------------
//  関数定義(START)
//----------------------------------------------------------------------

//NULLバイト除去
function sanitize($arr){
	if(is_array($arr)){
		return array_map('sanitize',$arr);
	}
	return str_replace("\0","",$arr);
}
//ファイル生成
function file_new_generate($str){
	$base_day = date("Y/m/d"); //日付の取得
	$fp = fopen($str,"a+b");
	flock ($fp,LOCK_EX);
	ftruncate($fp,0);
	rewind($fp);
	fwrite($fp,"$base_day,0");
	fclose($fp);
    @chmod($str, 0666);
}
//----------------------------------------------------------------------
//  関数定義(END)
//----------------------------------------------------------------------
?>