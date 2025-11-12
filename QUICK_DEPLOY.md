# 🚀 Railway Deploy - Quick Start (5 Minutes)

## The Problem (Why You Got Errors)

You were trying to run `php artisan serve` (a development server) in production on Railway. This crashes under load and causes 502 errors.

**What I fixed:**

-   ✅ Updated to use Octane/RoadRunner (production server)
-   ✅ Fixed nixpacks.toml build configuration
-   ✅ Removed hardcoded DB credentials
-   ✅ Set production-safe environment variables

---

## Can I Deploy Without Docker?

# ✅ YES!

You're now using **nixpacks** (Nix package manager). No Docker needed!

```
OLD:  Code → Dockerfile → Docker Image → Railway
NEW:  Code → nixpacks.toml → Railway (auto-installs packages)
                ↓
        Much faster & simpler!
```

---

## Deploy in 5 Steps

### 1️⃣ Push to GitHub

```powershell
git add .
git commit -m "chore: Railway deployment ready"
git push origin main
```

### 2️⃣ Open Railway.app

Go to https://railway.app

### 3️⃣ Create New Project

-   Click "New Project"
-   Select "Deploy from GitHub"
-   Choose your repo

### 4️⃣ Add MySQL Database

-   Click "Add Service"
-   Select "MySQL"
-   Done! Railway auto-links it

### 5️⃣ Set These 7 Variables

Click "Variables" and add:

```
APP_URL=https://your-app-name.up.railway.app
APP_ENV=production
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=app-password-16-chars (NOT regular password!)
MAIL_FROM_ADDRESS=your-email@gmail.com
```

### 6️⃣ Click Deploy

That's it! Wait 5-10 minutes. ✅

---

## What Happens During Deployment

```
1. Railway detects nixpacks.toml
2. Installs: PHP 8.2, Node 18, Composer
3. Runs build:
   - npm run build (Vite compiles CSS/JS)
   - composer install (PHP packages)
   - php artisan migrate (database setup)
4. Starts your app with Octane (fast server)
5. You can visit your live URL!
```

---

## Troubleshooting

### ❌ "502 Bad Gateway"

```
→ Check logs: Look in Railway dashboard under "Logs"
→ Common cause: Database not connected
→ Fix: Make sure MySQL service is linked
```

### ❌ "Can't connect to database"

```
→ In Railway dashboard, ensure MySQL service is linked
→ Click "Redeploy" button
→ Wait 1-2 minutes for variables to inject
```

### ❌ "CSS/JS not loading"

```
→ This means Vite build failed
→ Check logs for "npm run build" errors
→ Fix: Redeploy from Railway dashboard
```

### ❌ "Emails not sending"

```
→ Gmail requires an "App Password" (not your regular password)
→ Go to: https://myaccount.google.com/apppasswords
→ Select "Mail" and "Windows"
→ Copy the 16-char password
→ Paste into Railway MAIL_PASSWORD variable
```

---

## Files I Changed

✅ **nixpacks.toml** - Updated build/start phases  
✅ **Procfile** - Uses Octane now (was artisan serve)  
✅ **.env** - APP_DEBUG=false, MAIL_MAILER=log  
✅ **.env.railway** - NEW production config  
✅ **RAILWAY_DEPLOY.md** - Full deployment guide  
✅ **DEPLOY_CHECKLIST.md** - Detailed checklist  
✅ **RAILWAY_TECHNICAL_SUMMARY.md** - Technical details

---

## One-Liner Summary

**Problem**: Using dev server in production  
**Solution**: Use Octane + nixpacks (no Docker)  
**Deploy**: Push → Railway auto-builds → 5-10 mins → ✅ Live!

---

## Need Help?

1. **Quick troubleshooting** → See "Troubleshooting" above
2. **Full guide** → Read `RAILWAY_DEPLOY.md`
3. **Technical details** → Read `RAILWAY_TECHNICAL_SUMMARY.md`
4. **Deployment checklist** → Read `DEPLOY_CHECKLIST.md`

---

**Status**: 🟢 Ready to Deploy  
**Deploy Time**: ~5-10 minutes  
**Docker Required**: ❌ No (using nixpacks)
