# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to `YY.WW.PATCH` versioning (Year.Week.Patch).

## [Unreleased]

## [25.47.2] - 2025-11-19

### Fixed
- Deployed ENUM support and replacement character field to production installation
- Verified plugin configuration interface displays all fields correctly
- Confirmed replacement character field appears dynamically with `showon` attribute

### Changed
- Cleared Joomla cache to ensure updated plugin configuration is recognized

## [25.47.1] - 2025-11-18

### Added
- **ENUM support**: Added `ReplacementChar` enum for type-safe character replacement options
- **Configurable replacement character**: Users can now choose between hyphen (-), underscore (_), dot (.), or no replacement
- **Enhanced flexibility**: Replacement character field shows only when "Replace Spaces" is enabled

### Changed
- Improved code quality with PHP 8.1+ enum implementation
- Updated regex pattern to preserve dots in filenames
- Enhanced sanitization logic to handle different replacement characters dynamically
- Updated to strict comparison operator (`!==` instead of `!=`) for better type safety
- Changed `or die` to `|| die` to follow Joomla coding standards
- Improved code quality for Joomla 6 and PHP 8.3+ compatibility

## [25.47.0] - 2025-11-18

### Added
- Initial release of the Sanitize Filename plugin
- Feature: Replace spaces and underscores with hyphens
- Feature: Convert filenames to lowercase
- Feature: Remove special characters from filenames
- Feature: Clean up consecutive hyphens
- Feature: Trim hyphens from start and end of filenames
- Configuration options for all sanitization features
- English (en-GB) language support
- Dutch (nl-NL) language support
- Automatic filename sanitization on media upload
- Compatible with Joomla 4.x and 5.x

### Changed
- Nothing

### Deprecated
- Nothing

### Removed
- Nothing

### Fixed
- Nothing

### Security
- Nothing

[Unreleased]: https://github.com/hans2103/plg_media-action_sanitizefilename/compare/25.47.2...HEAD
[25.47.2]: https://github.com/hans2103/plg_media-action_sanitizefilename/compare/25.47.1...25.47.2
[25.47.1]: https://github.com/hans2103/plg_media-action_sanitizefilename/compare/25.47.0...25.47.1
[25.47.0]: https://github.com/hans2103/plg_media-action_sanitizefilename/releases/tag/25.47.0
