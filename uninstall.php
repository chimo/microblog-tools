<?php
// Copyright (c) 2011 - Stephane Berube 
// Quick fix to clean-up the database when uninstalling the plugin.
// FIXME: It would be nice not to have to duplicate twitter-tools.php's $aktt->options array

// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// This is an add-on for WordPress
// http://wordpress.org/
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if(!defined('WP_UNINSTALL_PLUGIN'))
	exit();

function aktt_uninstall() {

	$options = array(
		'twitter_username'
		, 'create_blog_posts'
		, 'create_digest'
		, 'create_digest_weekly'
		, 'digest_daily_time'
		, 'digest_weekly_time'
		, 'digest_weekly_day'
		, 'digest_title'
		, 'digest_title_weekly'
		, 'blog_post_author'
		, 'blog_post_category'
		, 'blog_post_tags'
		, 'notify_twitter'
		, 'sidebar_tweet_count'
		, 'tweet_from_sidebar'
		, 'give_tt_credit'
		, 'exclude_reply_tweets'
		, 'tweet_prefix'
		, 'last_tweet_download'
		, 'doing_tweet_download'
		, 'doing_digest_post'
		, 'install_date'
		, 'js_lib'
		, 'digest_tweet_order'
		, 'notify_twitter_default'
		, 'app_consumer_key'
		, 'app_consumer_secret'
		, 'oauth_token'
		, 'oauth_token_secret'
		, 'service'
		, 'host'
		, 'host_api'
		, 'api_post_status'
		, 'api_user_timeline'
		, 'api_status_show'
		, 'profile_url'
		, 'status_url'
		, 'hashtag_url'
		, 'authen_url'
		, 'author_url'
		, 'request_url'
		, 'access_url'
		, 'installed_version' /* Starting here, these options aren't in the twitter-tools.php $aktt->options array */
		, 'next_daily_digest'
		, 'next_weekly_digest'
		, 'oauth_hash'
		, 'update_hash'
	);
	 
	foreach ($options as $option) {
		delete_option('aktt_'.$option);
	}
}

aktt_uninstall();

?>