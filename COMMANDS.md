# Commands to Deploy

## 1️⃣ Commit & Push to GitHub

```powershell
cd c:\projs\Family_Management_System

# Add all changes
git add .

# Commit with message
git commit -m "chore: prepare for Railway deployment without Docker"

# Push to main branch
git push origin main
```

## 2️⃣ Deploy on Railway (in Dashboard)

### Step 1: Create New Project

```
Visit: https://railway.app
Click: "New Project"
Select: "Deploy from GitHub"
Choose: "Family_Management_System" repo
Click: "Deploy"
```

### Step 2: Add MySQL Service

```
In Railway Dashboard:
Click: "Add Service"
Select: "MySQL"
Click: "Create"
Wait: 1-2 minutes for service to start
```

### Step 3: Set Environment Variables

```
In Railway Dashboard, click "Variables":

Set these 8 variables:
  APP_URL=https://your-railway-app.up.railway.app
  APP_ENV=production
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.gmail.com
  MAIL_PORT=587
  MAIL_USERNAME=your-email@gmail.com
  MAIL_PASSWORD=your-app-password
  MAIL_FROM_ADDRESS=your-email@gmail.com

Click "Save"
```

### Step 4: Redeploy

```
Click: "Redeploy"
Wait: 5-10 minutes (watch the logs)
Visit: https://your-railway-app.up.railway.app
```

---

## 3️⃣ Monitor Deployment (Optional)

### Install Railway CLI (one-time)

```powershell
npm install -g @railway/cli
```

### Login to Railway

```powershell
railway login
```

### View Live Logs

```powershell
railway logs --follow
```

### SSH into Container (for debugging)

```powershell
railway run bash
```

### Manually Run Migrations

```powershell
railway run php artisan migrate --verbose
```

### Rebuild Frontend Assets

```powershell
railway run npm run build
```

---

## 4️⃣ Common Issues & Quick Fixes

### Issue 1: "502 Bad Gateway"

```powershell
# Check logs
railway logs --follow

# Most common cause: MySQL not linked
# Fix: Go to Railway dashboard → Add Service → MySQL → Create
# Then: Click Redeploy
```

### Issue 2: "Can't connect to database"

```powershell
# Check if MySQL is linked
# In Railway: click "Services" tab

# If not linked:
# → Add Service → MySQL → Create
# → Wait 2 minutes
# → Click Redeploy
```

### Issue 3: "Assets not loading (CSS/JS 404)"

```powershell
# This means Vite didn't build
# Check build logs for errors

# Manual fix:
railway run npm run build
railway run rails assets:precompile
```

### Issue 4: "Emails not sending"

```powershell
# Gmail requires App Password, not regular password
# Steps:
# 1. Go to: https://myaccount.google.com/apppasswords
# 2. Select "Mail" and "Windows"
# 3. Copy the 16-character password
# 4. In Railway dashboard:
#    - Set MAIL_PASSWORD to the 16-char password
#    - Click Redeploy
```

---

## 5️⃣ Redeployment After Code Changes

### Quick way (just push to GitHub):

```powershell
# Make changes to your code
# ...

git add .
git commit -m "Your commit message"
git push origin main

# Railway auto-detects and redeploys! ✅
# No need to manually click anything
```

### Or use Railway dashboard:

```
In Railway Dashboard:
Click: "Redeploy" button
```

---

## 6️⃣ Verify Deployment Success

### Check live app

```
Open browser: https://your-railway-app.up.railway.app
```

### Check logs for errors

```powershell
railway logs --follow
```

### Test database connection

```powershell
railway run php artisan tinker
```

Then in tinker:

```php
>>> User::count()
# Should return a number (not an error)
```

### Test file uploads

```powershell
railway run php artisan storage:link
```

---

## 7️⃣ Monitoring Commands

### View all services

```powershell
railway service list
```

### View deployment status

```powershell
railway status
```

### View environment variables

```powershell
railway env list
```

### Set a new env var

```powershell
railway env set MY_VAR=my_value
```

### Clear env var

```powershell
railway env unset MY_VAR
```

---

## 8️⃣ Debugging MySQL Issues

### Connect to Railway MySQL from CLI

```powershell
# First, get connection string from Railway dashboard
# It looks like: mysql://user:pass@host:port/database

# Install MySQL client (if not already installed)
# Windows: Install from https://dev.mysql.com/downloads/mysql/

# Connect to remote MySQL:
mysql -h your-host -u your-user -p your-database
```

### Check migrations

```powershell
railway run php artisan migrate:status
```

### Rollback migrations

```powershell
railway run php artisan migrate:rollback
```

### Fresh migrations (careful!)

```powershell
railway run php artisan migrate:fresh
```

---

## 9️⃣ Performance Monitoring

### Check error logs

```powershell
railway logs --follow | findstr ERROR
```

### Check request times

```powershell
railway logs --follow | findstr ms
```

### Monitor memory usage

```powershell
railway run bash
ps aux | grep php
```

---

## 🔟 Scale Up (Advanced)

### Increase worker processes

Edit `Procfile`:

```bash
# Before:
web: php artisan octane:start --server=roadrunner --host=0.0.0.0 --port=$PORT --workers=4

# After (increase workers):
web: php artisan octane:start --server=roadrunner --host=0.0.0.0 --port=$PORT --workers=8
```

Then redeploy!

---

## Summary

| Task               | Command                                        |
| ------------------ | ---------------------------------------------- |
| **Push to GitHub** | `git add . && git commit -m "msg" && git push` |
| **View logs**      | `railway logs --follow`                        |
| **SSH to app**     | `railway run bash`                             |
| **Redeploy**       | Click "Redeploy" in Railway dashboard          |
| **Check DB**       | `railway run php artisan tinker`               |
| **Rebuild assets** | `railway run npm run build`                    |
| **Run migrations** | `railway run php artisan migrate`              |

---

**Status**: ✅ Ready to Deploy  
**No Docker**: ✅ Using nixpacks  
**Time to Live**: ~5-10 minutes
