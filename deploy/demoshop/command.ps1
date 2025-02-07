# Get the directory where the script is located
$scriptPath = Split-Path -Parent $MyInvocation.MyCommand.Path

# Set the path for the drinkshop directory
$drinkshopPath = Join-Path $scriptPath "drinkshop"

# Check if the drinkshop directory exists
if (-not (Test-Path $drinkshopPath)) {
    Write-Host "Drinkshop directory not found, cloning the repository..."
    # Clone the repository with the specified tag to the drinkshop directory
    git clone --branch 1.1.0 --depth 1 https://github.com/alex005489465/drinkshop.git $drinkshopPath
    if ($LASTEXITCODE -ne 0) {
        Write-Host "Failed to clone the repository, please check your network connection or repository address."
        exit 1
    }
    Write-Host "Repository cloned successfully."
} else {
    Write-Host "Existing drinkshop directory found."
}

# Start Docker containers
Write-Host "Starting Docker containers..."
docker-compose -f docker-compose.demo.yml up -d

if ($LASTEXITCODE -ne 0) {
    Write-Host "Failed to start Docker containers, please check the docker-compose configuration."
    exit 1
}

Write-Host "Docker containers started successfully."
Write-Host "Please open http://localhost:8080 in your browser to view the demo shop."
