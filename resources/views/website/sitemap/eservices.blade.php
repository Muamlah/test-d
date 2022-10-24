<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($contents as $key=>$content)
    <?php
    $title = $content->service_name;
    $slug = \App\Helpers\HelperClass::strtoslug($title);
    ?>
        <url>
            <loc>{{url('/')."/eservices/".urlencode($slug)."?id=".$content->id}}</loc>
            <lastmod>{{ \Carbon\Carbon::parse($content->updated_at)->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.5</priority>
        </url>
    @endforeach
</urlset>
