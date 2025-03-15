# YDTB Patches Plugin

## Description
The YDTB Patches Plugin is designed to provide custom patches and enhancements for YDTB Clients & Customers. This is the location we put patches that seem to break multiple sites that we manage. 

### Text Domain Compatability. 
After the release of Wordpress 6.7 a new debug notice is being generated if the translation is not doing it the way wordpress wants. 
Unfortunately all we can do is notify the plugin authors about the notice, after notifying the plugin authors We would like to turn this off so that it does not cause other errors with headers already being sent out. 

### Removing Admin Notice Nags
There are several Admin Notice Nags that keep showing up and I want to remove them. There are other plugins that do this, but they all want money. It's a simple feat, and so I just implemented it here. 

#### This includes a WP-CLI to add/remove/list items from the list of hidden notices. 

* Add: ```wp hide-notice add "string in notice"```
* List: ```wp hide-notice list```
* Remove: ```wp hide-notice remove```

Note: The string must be short enough to not cross formatting changes in the notice. 
The filter is looking for the whole string but when the notice is checked if the string your are checking includes formatting then it won't match. 

For example the notice is:  The the plugin **Super Great Plugin** needs attention, you should check it out here: **linktothing**
If you copy the whole string then when its checked the checked string will look like this: ```The plugin <b> Super Great Plugin </b> needs attention...```
which will not match. 

I will work on making this simpler in the future, but for now it works for me. 

## Installation
1. Download the plugin zip file from the releases section here on github. 
2. Navigate to the `Plugins` section in your WordPress admin dashboard.
3. Click on `Add New` and then `Upload Plugin`.
4. Choose the downloaded zip file and click `Install Now`.
5. Activate the plugin through the `Plugins` menu in WordPress.

## Usage
Once activated, the YDTB Patches Plugin will automatically apply the necessary patches and enhancements to your site. No additional configuration is required.

## Changelog
### 0.0.1 Initial Release

## Support
For support and inquiries, please contact [support@example.com](mailto:support@example.com).

## License
This plugin is licensed under the [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

## Credits
Developed by [Your Development Team](https://yourwebsite.com).
