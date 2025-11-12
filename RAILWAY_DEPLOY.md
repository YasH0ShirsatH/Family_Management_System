# Railway Deployment Guide - Family Management System

## Overview

This Laravel 12 app can be deployed on Railway **without Docker** using Procfile and nixpacks (Nix package manager).

---

## ✅ What Changed & Why

### **1. `nixpacks.toml` - Fixed**

-   ❌ **Before**: Used `php artisan serve` (development server, not for production)
-   ✅ **After**: Removed `[start]` command, letting Railway use `Procfile` instead
-   Added Nginx to packages (for possible future Nginx + PHP-FPM setup)
-   Uses build-phase caching instead of seeding (safer for CI/CD)

### **2. `Procfile` - Updated**

-   ❌ **Before**: `php artisan serve --host=0.0.0.0 --port=$PORT` (development)
-   ✅ **After**: Uses Octane (RoadRunner) if available, falls back to `artisan serve`
    ```
    web: php artisan octane:start --server=roadrunner --host=0.0.0.0 --port=$PORT || php artisan serve --host=0.0.0.0 --port=$PORT
    ```
-   Octane is already in your `composer.json`, so this will work!

### **3. `.env.railway` - New**

-   Created Railway-specific environment file with placeholders
-   Railway automatically injects `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` if you link a database
-   Set `APP_DEBUG=false` and `LOG_LEVEL=error` for production

### **4. `.env` - Updated**

-   Changed `APP_DEBUG=false` (was `true`)
-   Changed `MAIL_MAILER=log` for local testing (was `smtp`)
-   Updated `APP_NAME` to "Family Management System"

---

## 🚀 Deploy to Railway (Step-by-Step)

### **Prerequisites**

1. Push your code to GitHub
2. Create a Railway account (railway.app)
3. Link your GitHub repo to Railway

### **Setup Instructions**

#### **Option A: Deploy with MySQL (Recommended)**

1. **In Railway Dashboard:**

    - Click "New Project"
    - Select "Deploy from GitHub repo"
    - Choose your `Family_Management_System` repo
    - Railway auto-detects nixpacks builder ✓

2. **Add MySQL Service:**

    - Click "Add Service" → Select "MySQL"
    - Railway auto-injects DB variables into your app

3. **Set Environment Variables** (in Railway dashboard):

    ```
    APP_URL=https://your-app-name.up.railway.app
    APP_ENV=production
    APP_KEY=base64:JvMPCFZG4BWPu1zH98vjXe+NGQuLp8FRsvocFcygNfY=
    SESSION_DRIVER=database
    CACHE_STORE=database
    QUEUE_CONNECTION=database
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=your-email@gmail.com
    MAIL_PASSWORD=your-app-password  (NOT regular password; use Gmail app password)
    MAIL_FROM_ADDRESS=your-email@gmail.com
    MAIL_FROM_NAME=Family Management System
    ```

4. **Railway Deploy Steps** (automatic):
    - Installs PHP 8.2, Node 18, Composer, npm
    - Runs `composer install --no-dev --optimize-autoloader`
    - Runs `npm ci && npm run build` (Vite)
    - Caches config/routes/views
    - Starts the app using `Procfile` (Octane/RoadRunner)

---

#### **Option B: Deploy with PostgreSQL**

Same as Option A, but select PostgreSQL instead of MySQL.

Then update `DB_CONNECTION=pgsql` in environment variables.

---

#### **Option C: Deploy with SQLite** (for small projects only)

1. Add environment variable: `DB_CONNECTION=sqlite`
2. Create a volume in Railway dashboard for `/database` folder
3. Railway will persist the SQLite file

⚠️ **Note**: Not recommended for production apps with multiple dynos.

---

## 🔍 Troubleshooting

### **Issue 1: "502 Bad Gateway" Error**

**Cause**: App is crashing on startup.

**Fix**:

1. Check Railway logs:
    ```
    railway logs --follow
    ```
2. Common issues:
    - `DB_URL` or `DB_HOST` not set → Link MySQL service in dashboard
    - Missing `APP_KEY` → Set in dashboard
    - Migration failed → Check if DB is accessible

### **Issue 2: "Connection refused" to Database**

**Cause**: Railway hasn't linked the MySQL service yet, or credentials are wrong.

**Fix**:

1. In Railway dashboard, go to your app
2. Click "Add Service" → link to MySQL (not create new)
3. Wait 1-2 minutes for variables to inject
4. Redeploy: click "Redeploy"

### **Issue 3: "SQLSTATE[HY000]: General error: 1005"**

**Cause**: Foreign key constraints failing during migration.

**Fix**:

1. SSH into Railway container:
    ```
    railway run bash
    ```
2. Run migration manually:
    ```
    php artisan migrate --verbose
    ```
3. Check if tables already exist (safe to re-run)

### **Issue 4: Static assets (CSS/JS) not loading**

**Cause**: Vite build didn't run or manifest is missing.

**Fix**:

1. Ensure `npm run build` completed in build logs
2. Check `/public/build/manifest.json` exists
3. If not, manually rebuild:
    ```
    railway run npm run build
    ```

### **Issue 5: Emails not sending**

**Cause**: Gmail credentials wrong or "Less secure apps" disabled.

**Fix**:

1. Create a **Gmail App Password** (NOT your regular password):
    - Go to https://myaccount.google.com/apppasswords
    - Select "Mail" and "Windows"
    - Copy the 16-character password
    - Use this in `MAIL_PASSWORD` environment variable

---

## 📊 Monitoring & Logs

View logs in Railway dashboard or via CLI:

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login
railway login

# View logs
railway logs --follow

# SSH into container
railway run bash
```

---

## 🔄 Redeployment After Code Changes

Simply push to GitHub:

```bash
git add .
git commit -m "Fix: update Railway config"
git push origin main
```

Railway auto-detects and redeploys! 🎉

---

## 📋 Checklist Before Deploying

-   [ ] All sensitive data removed from `.env` (moved to Railway dashboard)
-   [ ] `APP_DEBUG=false` in Railway environment
-   [ ] `APP_URL` set to your Railway domain
-   [ ] MySQL/Postgres service linked to app
-   [ ] `APP_KEY` set (or auto-generated via `php artisan key:generate`)
-   [ ] Migrations will run automatically (`php artisan migrate --force`)
-   [ ] Vite assets built (`npm run build`)
-   [ ] Octane/RoadRunner will start (or fallback to `artisan serve`)

---

## 🎯 Next Steps

1. **Commit changes to GitHub**:

    ```bash
    git add .
    git commit -m "chore: prepare for Railway deployment"
    git push origin main
    ```

2. **Create Railway Project**:

    - Go to https://railway.app
    - New Project → Deploy from GitHub
    - Select this repo

3. **Link Database**:

    - Add MySQL service in Railway dashboard
    - Wait for env vars to inject

4. **Redeploy**:

    - Click "Redeploy" in Railway dashboard
    - Wait for build/deploy (5-10 mins)

5. **Test Live**:
    - Visit `https://your-app.up.railway.app`
    - Check logs for errors

---

## 🚫 Deploy WITHOUT Docker

**Yes, confirmed!** Your setup now:

-   ✅ Uses `nixpacks` (Nix package manager, NOT Docker)
-   ✅ Uses `Procfile` to define web process
-   ✅ No `Dockerfile` required
-   ✅ Railway auto-detects and builds

---

## 📚 Additional Resources

-   [Railway Docs](https://docs.railway.app)
-   [Laravel on Railway](https://docs.railway.app/guides/laravel)
-   [Procfile Format](https://devcenter.heroku.com/articles/procfile)
-   [Laravel Octane](https://laravel.com/docs/octane)

---

**Created**: November 12, 2025  
**For**: Family Management System  
**Framework**: Laravel 12 | **PHP**: 8.2 | **Node**: 18
