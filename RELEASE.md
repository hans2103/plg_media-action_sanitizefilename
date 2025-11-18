# Release Process

This document describes how to create a new release of the plugin.

## Version Format

The plugin uses `YY.MM.NN` versioning:
- `YY`: Last two digits of the year (e.g., 25 for 2025)
- `MM`: Month (01-12, zero-padded)
- `NN`: Incremental patch number (00, 01, 02, etc., zero-padded)

Examples:
- `25.11.00` - First release in November 2025
- `25.11.01` - First patch in November 2025
- `25.12.00` - First release in December 2025

## Creating a Release

### 1. Update CHANGELOG.md

Before creating a release, update the `CHANGELOG.md` file:

```markdown
## [25.11.01] - 2025-11-20

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
git commit -m "Prepare for release 25.11.01"
git push origin main
```

### 3. Create and Push Tag

The GitHub Actions workflow is triggered by pushing a tag in the `YY.MM.NN` format:

```bash
# Create a tag
git tag 25.11.01

# Push the tag to GitHub
git push origin 25.11.01
```

### 4. Automatic Release Process

Once you push the tag, GitHub Actions will automatically:

1. ✓ Validate the version format
2. ✓ Update the version in `sanitizefilename.xml`
3. ✓ Run the build script to create the zip package
4. ✓ Extract the changelog for this version
5. ✓ Create a GitHub Release with:
   - Release name: "Release YY.MM.NN"
   - Release notes from CHANGELOG.md
   - Attached zip file for download
6. ✓ Upload the build artifact (kept for 90 days)

### 5. Verify Release

1. Go to https://github.com/yourusername/plg_media-action_sanitizefilename/releases
2. Verify the release was created correctly
3. Download the zip file and test it

## GitHub Repository Setup

### 1. Create GitHub Repository

1. Go to https://github.com/new
2. Repository name: `plg_media-action_sanitizefilename`
3. Description: "Joomla media-action plugin to sanitize filenames"
4. Choose: Public or Private
5. Do NOT initialize with README (we already have one)
6. Click "Create repository"

### 2. Push to GitHub

```bash
# Add remote
cd ~/Development/plg_media-action_sanitizefilename
git remote add origin git@github.com:yourusername/plg_media-action_sanitizefilename.git

# Rename branch to main (if needed)
git branch -M main

# Push to GitHub
git push -u origin main
```

### 3. Create First Release

```bash
# Create and push the first tag
git tag 25.11.00
git push origin 25.11.00
```

The GitHub Actions workflow will automatically create the release!

## Manual Build (for testing)

If you want to build the package locally without creating a release:

```bash
cd ~/Development/plg_media-action_sanitizefilename
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
git tag 25.11.01
git push origin main
git push origin 25.11.01
```

## Troubleshooting

### Release workflow fails

- Check the Actions tab on GitHub for error logs
- Ensure tag format is correct: `YY.MM.NN`
- Verify all required files exist
- Check that CHANGELOG.md has an entry for the version

### Build fails locally

- Ensure build.sh is executable: `chmod +x build.sh`
- Verify all plugin files are present
- Check for syntax errors: `php -l src/Extension/Sanitizefilename.php`

### Version mismatch

The GitHub Actions workflow automatically updates the version in `sanitizefilename.xml` to match the tag, so you don't need to update it manually before creating a release.
