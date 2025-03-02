# Custom Fields Anywhere

Custom Fields Anywhere is an Elementor addon that allows users to embed Elementor templates with dynamically populated custom fields from specific posts.

## Features
- Select any post from supported post types
- Choose an Elementor Container template to display the post with
- Works with custom fields for enhanced dynamic content (Pods, ACF)
- Fully integrates with Elementor and Elementor Pro

## Requirements
- WordPress 5.6 or higher
- PHP 7.4 or higher
- Elementor (Free) 3.25.0 or higher
- Elementor Pro 3.25.0 or higher

## Installation
1. Download and install the plugin via the WordPress plugin manager or manually upload it to `/wp-content/plugins/`.
2. Ensure Elementor and Elementor Pro are installed and active.
3. Activate the plugin from the WordPress dashboard.

## Usage
1. **Create an Elementor Template**  
   - In the Elementor template editor, create a **Container template**.  
   - Connect the **custom fields of the selected post type** to Elementor elements using dynamic tags.
   
2. **Add the Widget**  
   - Open Elementor and add the **Custom Field Template Wrapper** widget.

3. **Select Content Source**  
   - Choose a post from the available post types to retrieve dynamic content.

4. **Apply the Template**  
   - Select the Elementor template that defines how the post content should be displayed.

5. **Save & Publish**  
   - Apply changes and preview the dynamic content.


## Troubleshooting
- If the widget does not appear, verify that both Elementor and Elementor Pro are installed and activated.
- Ensure your selected Elementor template is a Container template published and accessible.
- If dynamic fields do not populate, confirm that your post has valid custom fields.

## Support
For issues and feature requests, visit the [GitHub repository](https://github.com/fragrance99/custom-fields-anywhere) or contact the author.

## License
This plugin is licensed under the **GNU General Public License v3.0 (GPL-3.0)**.  
You may use, modify, and distribute this plugin under the terms of the GPL-3.0.  

For more details, see the [full license](LICENSE) or visit:  
[https://www.gnu.org/licenses/gpl-3.0.html](https://www.gnu.org/licenses/gpl-3.0.html)
