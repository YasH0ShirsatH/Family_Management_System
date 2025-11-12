# 🚀 Quick Deploy Checklist

## ✅ What I Fixed for Railway

1. **nixpacks.toml** ✓

    - Removed `php artisan serve` (development-only command)
    - Added proper build phase caching
    - Now uses Procfile for startup

2. **Procfile** ✓

    - Updated to use Octane/RoadRunner (fast, production-ready)
    - Fallback to `artisan serve` if Octane fails
    - Your `composer.json` already has `laravel/octane` installed

3. **.env** ✓

    - Set `APP_DEBUG=false` (was dangerous in prod)
    - Changed `MAIL_MAILER=log` for local testing
    - Updated app name

4. **.env.railway** ✓ NEW

    - Railway-specific production config
    - Database URL placeholders
    - Ready for Railway's auto-injected environment variables

5. **RAILWAY_DEPLOY.md** ✓ NEW
    - Complete step-by-step deployment guide
    - Troubleshooting all common Railway issues
    - Monitoring and logging instructions

---

## 🎯 Deploy Now in 5 Steps

### Step 1: Commit to GitHub

```powershell
git add .
git commit -m "chore: prepare for Railway deployment"
git push origin main
```

### Step 2: Create Railway Project

-   Visit https://railway.app
-   Click "New Project"
-   Select "Deploy from GitHub"
-   Choose `Family_Management_System` repo

### Step 3: Add MySQL Service

-   In Railway dashboard, click "Add Service"
-   Select "MySQL"
-   Railway auto-links to your app

### Step 4: Set Environment Variables

In Railway dashboard, set these:

```
APP_URL=https://your-railway-app.up.railway.app
APP_ENV=production
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=gmail-app-password (NOT regular password!)
MAIL_FROM_ADDRESS=your-email@gmail.com
```

### Step 5: Deploy

Click "Redeploy" button → Wait 5-10 minutes → ✅ Done!

---

## ❓ FAQ

### Q: Can I deploy WITHOUT Docker?

✅ **YES!** You're now using **nixpacks** (Nix package manager), not Docker.

### Q: Why Procfile + nixpacks.toml?

-   `nixpacks.toml` = tells Railway which packages/tools to install
-   `Procfile` = tells Railway which command to run
-   No Dockerfile needed!

### Q: Will my database work?

✅ **YES!** Railway auto-injects `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` when you link MySQL service.

### Q: What about migrations?

✓ Automatically runs in build phase: `php artisan migrate --force`

### Q: Will my assets (CSS/JS) work?

✓ Vite builds during `npm run build` → Assets served from `/public/build`

---

## 📖 Full Documentation

See **RAILWAY_DEPLOY.md** for:

-   Detailed setup (Option A: MySQL, Option B: Postgres, Option C: SQLite)
-   Troubleshooting 502 errors, DB connection issues, etc.
-   Logs & monitoring commands
-   Redeployment workflow

---

## 🚨 Common Issues & Quick Fixes

| Issue               | Cause                | Fix                                                        |
| ------------------- | -------------------- | ---------------------------------------------------------- |
| 502 Bad Gateway     | App crashing         | Check logs: `railway logs --follow`                        |
| Can't connect to DB | DB not linked        | Link MySQL in Railway dashboard, redeploy                  |
| Assets 404          | Vite didn't build    | Redeploy, ensure `npm run build` completes                 |
| Emails not sending  | Wrong Gmail password | Use Gmail App Password (16-char from myaccount.google.com) |
| Migration failed    | DB connection error  | Ensure DB is running, check `DB_HOST` in logs              |

---

**Status**: ✅ Ready to Deploy  
**No Docker Required**: ✅ Using nixpacks  
**Deployment Time**: ~5-10 minutes
