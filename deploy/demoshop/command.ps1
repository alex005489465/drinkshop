# 獲取腳本所在的目錄
$scriptPath = Split-Path -Parent $MyInvocation.MyCommand.Path

# 設置 drinkshop 目錄的路徑
$drinkshopPath = Join-Path $scriptPath "drinkshop"

# 檢查 drinkshop 目錄是否存在
if (-not (Test-Path $drinkshopPath)) {
    Write-Host "未找到 drinkshop 目錄，正在克隆倉庫..."
    # 克隆指定標籤的倉庫到 drinkshop 目錄
    git clone --branch 1.1.0 --depth 1 https://github.com/alex005489465/drinkshop.git $drinkshopPath
    if ($LASTEXITCODE -ne 0) {
        Write-Host "克隆倉庫失敗，請檢查網絡連接或倉庫地址。"
        exit 1
    }
    Write-Host "倉庫克隆成功。"
} else {
    Write-Host "發現現有的 drinkshop 目錄。"
}

# 啟動 Docker 容器
Write-Host "正在啟動 Docker 容器..."
docker-compose -f docker-compose.demo.yml up -d

if ($LASTEXITCODE -ne 0) {
    Write-Host "Docker 容器啟動失敗，請檢查 docker-compose 配置。"
    exit 1
}

Write-Host "Docker 容器已成功啟動！"