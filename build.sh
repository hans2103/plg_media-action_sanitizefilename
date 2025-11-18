#!/bin/bash

# Build script for plg_media-action_sanitizefilename
# Creates a distributable zip package

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Get plugin version from XML file
VERSION=$(grep -oP '(?<=<version>)[^<]+' sanitizefilename.xml)
PLUGIN_NAME="plg_media-action_sanitizefilename"
ZIP_NAME="${PLUGIN_NAME}.zip"

echo -e "${GREEN}Building ${PLUGIN_NAME} v${VERSION}${NC}"

# Clean up old build
if [ -f "${ZIP_NAME}" ]; then
    echo -e "${YELLOW}Removing old build: ${ZIP_NAME}${NC}"
    rm "${ZIP_NAME}"
fi

# Files and folders to include in the zip
FILES=(
    "sanitizefilename.xml"
    "services"
    "src"
    "language"
)

# Create zip archive
echo -e "${GREEN}Creating zip archive...${NC}"
zip -r "${ZIP_NAME}" "${FILES[@]}" -x "*.DS_Store" -x "*/.*" -x "*~"

# Check if zip was created successfully
if [ -f "${ZIP_NAME}" ]; then
    SIZE=$(ls -lh "${ZIP_NAME}" | awk '{print $5}')
    echo -e "${GREEN}✓ Build complete: ${ZIP_NAME} (${SIZE})${NC}"
    echo -e "${GREEN}✓ Version: ${VERSION}${NC}"
else
    echo -e "${RED}✗ Build failed${NC}"
    exit 1
fi

# Display contents of the zip
echo -e "\n${YELLOW}Package contents:${NC}"
unzip -l "${ZIP_NAME}"

echo -e "\n${GREEN}Build successful!${NC}"
