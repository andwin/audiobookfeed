<?php
$audiobooks = array();

if ($handle = opendir('mp3')) {
        while (false !== ( $file = readdir($handle) )) {
                if (strpos($file, '.') !== 0) {
                        $audiobook = array();
                        $audiobook[ 'name' ] = str_replace( '.mp3', '', $file);
                        $audiobook[ 'url' ] = 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']. '/mp3/' . $file;
                        $audiobook[ 'size' ] = filesize( 'mp3/' . $file );

                        $audiobooks[] = $audiobook;
                }
        }
        closedir($handle);
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>"
?>
<rss version="2.0">
        <channel>
                <title>audiobooks</title>
                <description></description>
                <link></link>
                <language></language>
                <copyright></copyright>
                <lastBuildDate></lastBuildDate>
                <pubDate></pubDate>
                <docs></docs>
                <webMaster></webMaster>

                <?php foreach($audiobooks as $audiobook) { ?>
                <item>
                        <title><?=$audiobook[ 'name' ]?></title>
                        <link><?=$audiobook[ 'url' ]?></link>
                        <guid><?=$audiobook[ 'url' ]?></guid>
                        <description></description>
                        <enclosure url="<?=$audiobook[ 'url' ]?>" length="<?=$audiobook[ 'size' ]?>" type="audio/mpeg"/>
                        <category>Podcasts</category>
                </item>
                <?php } ?>
        </channel>

</rss>
