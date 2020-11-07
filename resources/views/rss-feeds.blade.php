
<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title>{{$section_name}} | The Guardian></title>
        <link>{{'https://www.theguardian.com/'.$section_name}}</link>
        <description>Description Of The Page</description>
        <language>en</language>

        @foreach($articles as $article)
            <item>
                <title>{{$article ['webTitle']}}</title>
                <link>{{ $article['webUrl'] }}</link>
                @foreach($article['blocks']['body'] as $body)

            <description>{{$body['bodyHtml']}}</description>

           
            @endforeach
            @foreach($article['tags'] as $author)
                <author>{{$author['webTitle']}}</author>
                @endforeach
                <guid>{{$article['webUrl']}}</guid>
                <pubDate>{{date('l, F d y h:i:s',strtotime($article['webPublicationDate'])) .' '.'GMT'}}</pubDate>
         
                 </item>
        @endforeach
       

    </channel>
</rss>