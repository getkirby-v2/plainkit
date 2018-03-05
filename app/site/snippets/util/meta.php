<? $title = $site->title()->html() ?>
<? if (isset($page) && !$page->isHomePage()) $title = "{$page->title()} | $title" ?>

<? $description = isset($page) && $page->meta_description()->isNotEmpty() ? $page->meta_description()->html() : $site->meta_description()->html() ?>
<? $previewImage = isset($page) && $page->meta_image()->toFile() ? $page->meta_image()->toFile() : $site->meta_image()->toFile() ?>

<? /* Humans */ ?>
<title><?= $title ?></title>

<meta name="description" content="<?= $description ?>">
<meta name="subject" content="<?= $site->meta_subject()->html() ?>">
<link rel="author" href="humans.txt">

<? /* Social + Open Graph */ ?>
<meta property="og:url" content="<?= $site->url() ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= $title ?>">
<? if ($previewImage) { ?>
  <meta property="og:image" content="<?= $previewImage->thumb('thumbnail')->url() ?>">
<? } ?>
<meta property="og:description" content="<?= $description ?>">
<meta property="og:site_name" content="<?= $site->title() ?>">
<meta property="og:locale" content="en_US">
<meta property="article:author" content="">

<meta name="twitter:card" content="<?= $previewImage ? 'summary_large_image' : 'summary' ?>">
<meta name="twitter:site" content="">
<meta name="twitter:creator" content="">
<meta name="twitter:url" content="<?= isset($page) ? $page->url() : $site->url() ?>">
<meta name="twitter:title" content="<?= $title ?>">
<meta name="twitter:text:title" content="<?= $title ?>">
<meta name="twitter:description" content="<?= $description ?>">
<? if ($previewImage) { ?>
  <meta name="twitter:image" content="<?= $previewImage->thumb('thumbnail')->url() ?>">
<? } ?>

<? /* Crawlers, Bots, Etc */ ?>
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<meta name="generator" content="Kirby CMS">

<? /* Location */ ?>
<? if ($site->location()->isNotEmpty() && $location = $site->location()->yaml()) { ?>
  <meta name="geo.position" content="<?= $location['lat'] ?>; <?= $location['lng'] ?>">
  <meta name="geo.region" content="US">
  <meta name="geo.placename" content="<?= $location['address'] ?>">
<? } ?>

<? /* Languages */ ?>
<? if (isset($page) && $site->languages()->count() > 1) { ?>
  <? foreach ($site->languages() as $language) { ?>
    <?= html::tag('link', null, [
      'rel' => 'alternate',
      'hreflang' => $language->code(),
      'href' => $page->url($language->code())
    ]); ?>
  <? } ?>
<? } ?>

<? /* Assets */ ?>
<link rel="icon" href="/assets/images/favicon.ico">
