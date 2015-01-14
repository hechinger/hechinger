<?php

/**
 * The template for Partners page.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$context['post'] = new HechingerPost($post);
$context['partners'] = array(
  array(
    "name" => "American Public Media",
    "image" => "icn-partner-american_public_media.png",
    "link" => "http://www.americanpublicmedia.org/"
  ),
  array(
    "name" => "Business Insider",
    "image" => "icn-partner-business_insider.png",
    "link" => "http://www.businessinsider.com/"
  ),
  array(
    "name" => "California Watch",
    "image" => "icn-partner-california_watch.png",
    "link" => "http://californiawatch.org/"
  ),
  array(
    "name" => "Captial",
    "image" => "icn-partner-capital.png",
    "link" => "http://www.capitalnewyork.com/"
  ),
  array(
    "name" => "Center for Investigative Reporting",
    "image" => "icn-partner-center_for_investigative_reporting.png",
    "link" => "http://cironline.org/"
  ),
  array(
    "name" => "CNN",
    "image" => "icn-partner-CNN.png",
    "link" => "http://www.cnn.com/"
  ),
  array(
    "name" => "CNN Money",
    "image" => "icn-partner-CNN_money.png",
    "link" => "http://money.cnn.com/"
  ),
  array(
    "name" => "EdSource",
    "image" => "icn-partner-ed_source.png",
    "link" => "http://edsource.org/"
  ),
  array(
    "name" => "Education Week",
    "image" => "icn-partner-education_week.png",
    "link" => "http://www.edweek.org/"
  ),
  array(
    "name" => "Education Writer's Association",
    "image" => "icn-partner-ewa.png",
    "link" => "http://www.ewa.org/"
  ),
  array(
    "name" => "Indianapolis Star",
    "image" => "icn-partner-indy_star.png",
    "link" => "http://www.indystar.com/"
  ),
  array(
    "name" => "Jackson Free Press",
    "image" => "icn-partner-jackson_free_press.png",
    "link" => "http://www.jacksonfreepress.com/"
  ),
  array(
    "name" => "Juvenile Justice Information Exchange",
    "image" => "icn-partner-juvenile_justice_information_exchange.png",
    "link" => "http://jjie.org/"
  ),
  array(
    "name" => "KPCC",
    "image" => "icn-partner-KPCC.png",
    "link" => "http://www.scpr.org/"
  ),
  array(
    "name" => "Marketplace",
    "image" => "icn-partner-marketplace.png",
    "link" => "http://www.marketplace.org/"
  ),
  array(
    "name" => "McClatchy",
    "image" => "icn-partner-mcclatchy.png",
    "link" => "http://www.mcclatchydc.com/"
  ),
  array(
    "name" => "Minnesota Public Radio",
    "image" => "icn-partner-minnesota_public_radio.png",
    "link" => "http://minnesota.publicradio.org/"
  ),
  array(
    "name" => "MinnPost",
    "image" => "icn-partner-minn_post.png",
    "link" => "http://www.minnpost.com/"
  ),
  array(
    "name" => "Mississippi Public Broadcasting",
    "image" => "icn-partner-mississippi_public_broadcasting.png",
    "link" => "http://www.mpbonline.org/"
  ),
  array(
    "name" => "Money",
    "image" => "icn-partner-money.png",
    "link" => "http://time.com/money/"
  ),
  array(
    "name" => "NBC News",
    "image" => "icn-partner-nbc_news.png",
    "link" => "http://www.nbcnews.com/"
  ),
  array(
    "name" => "New England Center for Investigative Reporting",
    "image" => "icn-partner-new_england_CIR.png",
    "link" => "http://necir.org/"
  ),
  array(
    "name" => "New Haven Independent",
    "image" => "icn-partner-new_haven_independent.png",
    "link" => "http://www.newhavenindependent.org/"
  ),
  array(
    "name" => "Next City",
    "image" => "icn-partner-next_city.png",
    "link" => "http://nextcity.org/"
  ),
  array(
    "name" => "NJ Spotlight",
    "image" => "icn-partner-nj_spotlight.png",
    "link" => "http://www.njspotlight.com/"
  ),
  array(
    "name" => "Northeast Mississippi Daily Journal",
    "image" => "icn-partner-northeast_mississippi_daily_journal.png",
    "link" => "http://djournal.com/"
  ),
  array(
    "name" => "Omaha.com",
    "image" => "icn-partner-omaha.com.png",
    "link" => "http://www.omaha.com/"
  ),
  array(
    "name" => "PBS Newshour",
    "image" => "icn-partner-pbs_newshour.png",
    "link" => "http://www.pbs.org/newshour/topic/education/"
  ),
  array(
    "name" => "Politico Magazine",
    "image" => "xxxxx.png",
    "link" => "http://www.politico.com/magazine/"
  ),
  array(
    "name" => "Providence Journal",
    "image" => "icn-partner-providence_journal.png",
    "link" => "http://www.providencejournal.com/"
  ),
  array(
    "name" => "Rethink Mississippi",
    "image" => "icn-partner-rethink_mississippi.png",
    "link" => "http://www.rethinkms.org/"
  ),
  array(
    "name" => "Slate",
    "image" => "icn-partner-slate.png",
    "link" => "http://www.slate.com/"
  ),
  array(
    "name" => "State Impact",
    "image" => "icn-partner-state_impact.png",
    "link" => "http://stateimpact.npr.org/"
  ),
  array(
    "name" => "SunHerald.com",
    "image" => "icn-partner-sun_herald.png",
    "link" => "http://www.sunherald.com/"
  ),
  array(
    "name" => "The Advocate",
    "image" => "icn-partner-Advocate.png",
    "link" => "http://www.advocate.com/"
  ),
  array(
    "name" => "The American Prospect",
    "image" => "icn-partner-American_Prospect.png",
    "link" => "http://prospect.org/"
  ),
  array(
    "name" => "The Arizona Republic",
    "image" => "icn-partner-arizona_republic.png",
    "link" => "http://www.azcentral.com/topic/e85b7e4c-ae59-4084-9af1-020df1406d1d/the-arizona-republic-online/"
  ),
  array(
    "name" => "The Atlantic",
    "image" => "icn-partner-atlantic.png",
    "link" => "http://theatlantic.com"
  ),
  array(
    "name" => "The Boston Globe",
    "image" => "icn-partner-boston_globe.png",
    "link" => "http://www.bostonglobe.com/"
  ),
  array(
    "name" => "The Chicago Tribune",
    "image" => "icn-partner-chicago_tribune.png",
    "link" => "http://www.chicagotribune.com/"
  ),
  array(
    "name" => "The Christian Science Monitor",
    "image" => "icn-partner-christian_science_monitor.png",
    "link" => "http://www.csmonitor.com/"
  ),
  array(
    "name" => "The Chronical of Higher Education",
    "image" => "icn-partner-chronicle_of_higher_ed.png",
    "link" => "http://chronicle.com/"
  ),
  array(
    "name" => "The Clarion Ledger",
    "image" => "icn-partner-clarion_ledger.png",
    "link" => "http://www.clarionledger.com/"
  ),
  array(
    "name" => "The Commerical Appeal",
    "image" => "icn-partner-commercial_appeal.png",
    "link" => "http://www.commercialappeal.com/"
  ),
  array(
    "name" => "The CT Mirror",
    "image" => "icn-partner-ct_mirror.png",
    "link" => "http://ctmirror.org/"
  ),
  array(
    "name" => "The Dallas Morning News",
    "image" => "icn-partner-dallas_morning_news.png",
    "link" => "http://www.dallasnews.com/"
  ),
  array(
    "name" => "The Huffington Post",
    "image" => "icn-partner-huffington_post.png",
    "link" => "http://www.huffingtonpost.com/"
  ),
  array(
    "name" => "The Lens",
    "image" => "icn-partner-the_lens.png",
    "link" => "http://thelensnola.org/"
  ),
  array(
    "name" => "The Los Angeles Times",
    "image" => "icn-partner-LA_times.png",
    "link" => "http://www.latimes.com/"
  ),
  array(
    "name" => "The Miami Herald",
    "image" => "icn-partner-miami_herald.png",
    "link" => "http://www.miamiherald.com/"
  ),
  array(
    "name" => "The Milwaukee Journal Sentinel",
    "image" => "icn-partner-milwaukee_journal_sentinel.png",
    "link" => "http://www.jsonline.com/"
  ),
  array(
    "name" => "The Nation",
    "image" => "icn-partner-nation.png",
    "link" => "http://www.thenation.com/"
  ),
  array(
    "name" => "The Philadelphia Inquirer",
    "image" => "icn-partner-philadelphia_inquirer.png",
    "link" => "http://www.philly.com/"
  ),
  array(
    "name" => "The Seattle Times",
    "image" => "icn-partner-seattle_times.png",
    "link" => "http://seattletimes.com/html/home/index.html"
  ),
  array(
    "name" => "The Tennessean",
    "image" => "icn-partner-tennessean.png",
    "link" => "http://www.tennessean.com/"
  ),
  array(
    "name" => "The Texas Tribune",
    "image" => "icn-partner-texas_tribune.png",
    "link" => "https://www.texastribune.org/"
  ),
  array(
    "name" => "The Times-Picayune",
    "image" => "icn-partner-times_picayune.png",
    "link" => "http://www.nola.com/t-p/"
  ),
  array(
    "name" => "The Washington Post",
    "image" => "icn-partner-washington_post.png",
    "link" => "http://www.washingtonpost.com/"
  ),
  array(
    "name" => "Time",
    "image" => "icn-partner-time.png",
    "link" => "http://time.com"
  ),
  array(
    "name" => "Us News and World Report",
    "image" => "icn-partner-us_news_and_world_report.png",
    "link" => "http://www.usnews.com/"
  ),
  array(
    "name" => "USA Today",
    "image" => "icn-partner-usa_today.png",
    "link" => "http://www.usatoday.com/"
  ),
  array(
    "name" => "Washington Monthly",
    "image" => "icn-partner-washington_monthly.png",
    "link" => "http://www.washingtonmonthly.com/"
  ),
  array(
    "name" => "WBEZ 91.5 Chicago",
    "image" => "icn-partner-wbez.png",
    "link" => "http://www.wbez.org/"
  ),
  array(
    "name" => "WGBH",
    "image" => "icn-partner-wgbh.png",
    "link" => "http://www.wgbh.org/"
  ),
  array(
    "name" => "WNYC",
    "image" => "icn-partner-wnyc.png",
    "link" => "http://www.wnyc.org/"
  ),
  array(
    "name" => "WWNO",
    "image" => "icn-partner-wwno.png",
    "link" => "http://wwno.org/"
  )

);

Timber::render('pages/partners.twig', $context);
