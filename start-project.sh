#!/bin/bash

# -----------------------------
# Start Laravel + XAMPP project
# -----------------------------

# Step 1: Auto start XAMPP
echo "Starting XAMPP..."
sudo /Applications/XAMPP/xamppfiles/xampp start
sleep 5  # Wait for XAMPP to fully start

# Step 2: Run npm dev server
echo "Starting npm dev..."
npm run dev &  # Run in background
sleep 2        # Short delay to ensure it starts

# Step 3: Create Laravel storage link
echo "Creating Laravel storage link..."
php artisan storage:link

# Step 4: Start Laravel queue worker
echo "Starting Laravel queue worker..."
php artisan queue:work &  # Run in background

# Step 5: Start Laravel development server
echo "Starting Laravel serve..."
php artisan serve
