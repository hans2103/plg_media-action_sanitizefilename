# Release Process

This document describes how to create a new release of the plugin.

## Version Format

The plugin uses `YY.WW.PATCH` versioning:
- `YY`: Last two digits of the year (e.g., 25 for 2025)
- `WW`: ISO week number (01-53)
- `PATCH`: Incremental patch number (0, 1, 2, etc.)

Examples:
- `25.47.0` - First release in week 47 of 2025
- `25.47.1` - First patch in week 47 of 2025
- `25.48.0` - First release in week 48 of 2025

## Creating a Release

### 1. Update CHANGELOG.md

Before creating a release, add a section for the new version to `CHANGELOG.md`. The release notes on GitHub are taken from this section, so the heading must match the tag exactly:

```markdown
## [25.47.1] - 2025-11-20

### Added
- New feature description

### Changed
- Change description

### Fixed
- Bug fix description
```

### 2. Commit Changes

```bash
git add CHANGELOG.md
git commit -m "Prepare for release 25.47.1"
git push origin main
```

### 3. Create and Push Tag

The GitHub Actions workflow is triggered by pushing a tag in the `YY.WW.PATCH` format:

```bash
# Create a tag
git tag 25.47.1

# Push the tag to GitHub
git push origin 25.47.1
```

### 4. Automatic Release Process

Once you push the tag, GitHub Actions will automatically:

1. ✓ Validate the version format
2. ✓ Update the version in `sanitizefilename.xml`
3. ✓ Run the build script and name the zip `plg_media-action_sanitizefilename-<version>.zip`
4. ✓ Extract the changelog section for this version
5. ✓ Create a GitHub Release with:
   - Release name: "Release YY.WW.PATCH"
   - Release notes from CHANGELOG.md
   - Attached zip file for download
6. ✓ Upload the build artifact (kept for 90 days)
7. ✓ Update `update.xml` and the manifest version on `main`, so installed sites see the new version through Joomla's update system

### 5. Verify Release

1. Go to https://github.com/hans2103/plg_media-action_sanitizefilename/releases
2. Verify the release was created correctly
3. Download the zip file and test it
4. Check that `update.xml` on `main` points to the new version

## Update Server

The manifest contains an `<updateservers>` entry that points to `update.xml` on the `main` branch:

`https://raw.githubusercontent.com/hans2103/plg_media-action_sanitizefilename/main/update.xml`

The release workflow keeps this file in sync. Do not edit the version or download URL by hand.

## Manual Build (for testing)

If you want to build the package locally without creating a release:

```bash
cd ~/Development/other/plg_media-action_sanitizefilename
./build.sh
```

This creates `plg_media-action_sanitizefilename.zip` in the repository root.

## Workflow Files

- `.github/workflows/release.yml` - Automatic release creation
- `.github/workflows/ci.yml` - Continuous integration checks

## Branch Strategy

- `main` - Production-ready code, all releases are tagged from here
- `develop` - Development branch (optional, for larger changes)
- Feature branches - For specific features/fixes

## Hotfix Process

For urgent fixes:

1. Create hotfix branch from main
2. Fix the issue
3. Update CHANGELOG.md
4. Merge to main
5. Create and push new tag (increment patch number)

Example:
```bash
git checkout main
git checkout -b hotfix/critical-fix
# ... make fixes ...
git add .
git commit -m "Fix critical issue"
git checkout main
git merge hotfix/critical-fix
git tag 25.47.1
git push origin main
git push origin 25.47.1
```

## Troubleshooting

### Release workflow fails

- Check the Actions tab on GitHub for error logs
- Ensure tag format is correct: `YY.WW.PATCH`
- Verify all required files exist
- Check that CHANGELOG.md has an entry for the version

### Build fails locally

- Ensure build.sh is executable: `chmod +x build.sh`
- Verify all plugin files are present
- Check for syntax errors: `php -l src/Extension/Sanitizefilename.php`

### Version mismatch

The GitHub Actions workflow updates the version in `sanitizefilename.xml` to match the tag, both for the package and on `main` after the release, so you don't need to update it manually.
