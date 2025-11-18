# Media Action - Sanitize Filename

A Joomla 4/5/6 media-action plugin that automatically sanitizes uploaded filenames by replacing spaces with your choice of character, converting to lowercase, and removing special characters.

## Features

- **Replace Spaces**: Automatically replaces spaces and underscores
- **Configurable Replacement Character**: Choose between hyphen (-), underscore (_), dot (.), or remove spaces entirely
- **PHP 8.1+ ENUM Support**: Type-safe replacement character selection using modern PHP enums
- **Lowercase Conversion**: Converts all characters to lowercase for consistency
- **Remove Special Characters**: Strips special characters, keeping only alphanumeric characters and chosen separators
- **Smart Cleanup**: Removes consecutive replacement characters and trims them from start/end
- **Fully Configurable**: All features can be toggled on/off individually

## Installation

### Method 1: Download from Releases

1. Download the latest `plg_media-action_sanitizefilename.zip` from the [Releases](../../releases) page
2. Go to **System → Install → Extensions** in your Joomla administrator
3. Upload the zip file
4. Enable the plugin at **System → Plugins → Media Action - Sanitize Filename**

### Method 2: Discover Installation

1. Upload the plugin folder to `/plugins/media-action/sanitizefilename`
2. Go to **System → Manage → Discover**
3. Click **Discover** to scan for new extensions
4. Select and install the plugin
5. Enable it in the plugin manager

## Configuration

After installation, configure the plugin at **System → Plugins → Media Action - Sanitize Filename**:

- **Replace Spaces**: Enable/disable space replacement (default: enabled)
- **Replacement Character**: Choose hyphen (-), underscore (_), dot (.), or none (default: hyphen)
- **Convert to Lowercase**: Convert filename to lowercase (default: enabled)
- **Remove Special Characters**: Remove special characters (default: enabled)

## Examples

### With Hyphen (default)
| Original Filename | Sanitized Filename |
|------------------|-------------------|
| `My Holiday Photo 2025.jpg` | `my-holiday-photo-2025.jpg` |
| `Product_Image #1.png` | `product-image-1.png` |
| `Screenshot (2025-11-18).png` | `screenshot-2025-11-18.png` |

### With Underscore
| Original Filename | Sanitized Filename |
|------------------|-------------------|
| `My Holiday Photo 2025.jpg` | `my_holiday_photo_2025.jpg` |
| `Product-Image #1.png` | `product_image_1.png` |

### With Dot
| Original Filename | Sanitized Filename |
|------------------|-------------------|
| `My Holiday Photo 2025.jpg` | `my.holiday.photo.2025.jpg` |
| `Product_Image #1.png` | `product.image.1.png` |

### No Replacement
| Original Filename | Sanitized Filename |
|------------------|-------------------|
| `My Holiday Photo 2025.jpg` | `myholidayphoto2025.jpg` |
| `Product_Image #1.png` | `productimage1.png` |

## Requirements

- Joomla 4.0 or higher
- Joomla 5.0 or higher
- PHP 8.1 or higher

## Versioning

This plugin uses `YY.WW.PATCH` versioning:
- `YY`: Last two digits of the year (e.g., 25 for 2025)
- `WW`: ISO week number (01-53)
- `PATCH`: Incremental patch number (0, 1, 2, etc.)

Examples:
- `25.47.0` = First release in week 47 of 2025
- `25.47.1` = First patch in week 47 of 2025
- `25.48.0` = First release in week 48 of 2025

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history and changes.

## Development

### Building from Source

```bash
# Clone the repository
git clone https://github.com/hans2103/plg_media-action_sanitizefilename.git
cd plg_media-action_sanitizefilename

# Build the package
./build.sh
```

The build script will create `plg_media-action_sanitizefilename.zip` in the root directory.

### Directory Structure

```
plg_media-action_sanitizefilename/
├── sanitizefilename.xml                    # Plugin manifest
├── services/
│   └── provider.php                        # Service provider
├── src/
│   └── Extension/
│       └── Sanitizefilename.php            # Main plugin class
└── language/
    ├── en-GB/
    │   ├── plg_media-action_sanitizefilename.ini
    │   └── plg_media-action_sanitizefilename.sys.ini
    └── nl-NL/
        ├── plg_media-action_sanitizefilename.ini
        └── plg_media-action_sanitizefilename.sys.ini
```

## License

GNU General Public License version 3 or later

## Author

**HKweb**
- Website: https://hkweb.nl
- Email: info@hkweb.nl

## Support

For bug reports and feature requests, please use the [GitHub Issues](../../issues) page.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request
