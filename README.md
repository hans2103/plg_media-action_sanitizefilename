# Media Action - Sanitize Filename

A Joomla 4/5 media-action plugin that automatically sanitizes uploaded filenames by replacing spaces with hyphens, converting to lowercase, and removing special characters.

## Features

- **Replace Spaces**: Automatically replaces spaces and underscores with hyphens
- **Lowercase Conversion**: Converts all characters to lowercase for consistency
- **Remove Special Characters**: Strips special characters, keeping only alphanumeric, hyphens, and underscores
- **Smart Cleanup**: Removes consecutive hyphens and trims hyphens from start/end
- **Configurable**: All features can be toggled on/off individually

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

- **Replace Spaces**: Replace spaces and underscores with hyphens (default: enabled)
- **Convert to Lowercase**: Convert filename to lowercase (default: enabled)
- **Remove Special Characters**: Remove special characters (default: enabled)

## Examples

| Original Filename | Sanitized Filename |
|------------------|-------------------|
| `My Holiday Photo 2025.jpg` | `my-holiday-photo-2025.jpg` |
| `Product_Image #1.png` | `product-image-1.png` |
| `Screenshot (2025-11-18).png` | `screenshot-2025-11-18.png` |
| `Café Menu Card.pdf` | `caf-menu-card.pdf` |

## Requirements

- Joomla 4.0 or higher
- Joomla 5.0 or higher
- PHP 8.1 or higher

## Versioning

This plugin uses `YY.MM.PATCHNUMBER` versioning:
- `YY`: Last two digits of the year (e.g., 25 for 2025)
- `MM`: Month (01-12)
- `PATCHNUMBER`: Incremental patch number (00, 01, 02, etc.)

Example: `25.11.00` = First release in November 2025

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history and changes.

## Development

### Building from Source

```bash
# Clone the repository
git clone https://github.com/yourusername/plg_media-action_sanitizefilename.git
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
