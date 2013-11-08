This plugin takes all img ressources in page and media configured on page and add them in og:image meta in head. The plugin checks if the user agent is a Facebook or LinkedIn bot to add this tags, so you'll never see them in content pages. You'll have to use Facebook debugger to see the result :

http://developers.facebook.com/tools/debug

LinkedIn has currently no debugger.

You can change or disable the page field used (media by default) to insert more pictures :

plugin.tx_facebookogtags_pi1.data_page_field >

You can manually add images in typoscript like this :

plugin.tx_facebookogtags_pi1 {
	images.1 = IMG_RESOURCE
	images.1.file = fileadmin/user_upload/file.jpg

	images.2 = IMG_RESOURCE
	images.2.file {
		import = uploads/my_directory/
		import.data = page:my_field
		import.listNum = 0
	}
}
