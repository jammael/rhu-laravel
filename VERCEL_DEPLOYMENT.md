# Vercel Deployment Guide for NutriCare Laravel 12

This guide walks you through deploying your Laravel 12 application to Vercel.

## Prerequisites

- Vercel account (https://vercel.com)
- GitHub/GitLab/Bitbucket repository with your code pushed
- A managed database (required - see options below)

## Step 1: Choose and Set Up a Managed Database

Vercel's filesystem is ephemeral, so you **cannot use SQLite locally stored on Vercel**. You must use a managed database service:

### Option A: PlanetScale (MySQL - Recommended)
1. Create a PlanetScale account: https://planetscale.com
2. Create a new database
3. Get your connection credentials (host, username, password, database name)
4. Run migrations in PlanetScale:
   ```bash
   php artisan migrate --database=mysql
   ```

### Option B: Supabase (PostgreSQL)
1. Create a Supabase account: https://supabase.com
2. Create a new project
3. Get your PostgreSQL connection string
4. Update `.env` to use PostgreSQL:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=your-host
   DB_PORT=5432
   DB_DATABASE=postgres
   DB_USERNAME=your-user
   DB_PASSWORD=your-password
   ```

### Option C: Vercel PostgreSQL (native integration)
1. In Vercel dashboard, create a Postgres database
2. Environment variables are automatically injected
3. Update `.env` to use the provided `POSTGRES_*` variables

## Step 2: Prepare Your Repository

Ensure your code is pushed to GitHub/GitLab with:
- `.env` file configured locally (not committed)
- `vercel.json` in root directory ✅ (already created)
- `api/index.php` entry point ✅ (already created)
- `.vercelignore` file ✅ (already created)
- `config/vercel.php` ✅ (already created)

## Step 3: Configure Vercel Environment Variables

In Vercel dashboard → Settings → Environment Variables, add:

### Required
```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APP_KEY  # Keep your existing key
APP_URL=https://your-domain.vercel.app  # You can update this after deployment
```

### Database (choose based on your service)
**PlanetScale:**
```
DB_CONNECTION=mysql
DB_HOST=aws.connect.psdb.cloud
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**Supabase PostgreSQL:**
```
DB_CONNECTION=pgsql
DB_HOST=your-host.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### Cache & Sessions
```
CACHE_STORE=array
SESSION_DRIVER=cookie
SESSION_ENCRYPT=true
QUEUE_CONNECTION=sync
LOG_LEVEL=error
```

### Optional - AWS S3 for file storage
If you want to store uploaded files on S3:
```
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your_key
AWS_SECRET_ACCESS_KEY=your_secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your_bucket
```

## Step 4: Deploy to Vercel

### Method 1: Via Vercel Dashboard (Easiest)
1. Go to https://vercel.com/dashboard
2. Click "Add New" → "Project"
3. Select your repository
4. Click "Import"
5. Vercel auto-detects PHP settings
6. Add environment variables from Step 3
7. Click "Deploy"

### Method 2: Via Vercel CLI
```bash
# Install Vercel CLI
npm install -g vercel

# Deploy
vercel --prod

# Follow prompts to add environment variables
```

## Step 5: Run Migrations on Vercel

After initial deployment, you need to run migrations on the Vercel database:

### Option A: Using Vercel CLI
```bash
vercel env pull  # Downloads production environment variables
php artisan migrate --env=production
```

### Option B: SSH into Vercel (not possible - use alternatives)
Instead, use one of these methods:

**Create a one-time migration route (temporary):**
Add this to `routes/web.php` temporarily:
```php
Route::get('/migrate', function () {
    if (app()->environment() !== 'production') {
        return 'Not in production';
    }
    Artisan::call('migrate:fresh', ['--force' => true]);
    return 'Migrations completed';
});
```

**Then call:** `curl https://your-app.vercel.app/migrate`

**Or use your database provider's UI:**
- PlanetScale: Web UI to manage data
- Supabase: Dashboard to view/edit data
- Run SQL migrations manually in the dashboard

## Step 6: Verify Deployment

1. Visit your Vercel app URL
2. Check that pages load correctly
3. Test database connectivity
4. Review logs in Vercel dashboard → Deployments → Function Logs

## Troubleshooting

### "502 Bad Gateway" Error
- Check `Function Logs` in Vercel dashboard
- Ensure all environment variables are set
- Verify database connection credentials

### Database Connection Errors
- Verify host, port, username, password
- Check if database allows connections from Vercel IP (usually allowed automatically)
- Test connection locally first: `php artisan tinker` → `DB::connection()->getPdo()`

### File Storage Not Working
- Use S3 for file storage (recommended for serverless)
- Or accept that files are temporary (lost after function ends)
- Implement cleanup/archive logic for important uploads

### 404 on All Routes
- Verify `vercel.json` rewrites are correct
- Check `api/index.php` is loading `public/index.php`
- Ensure `.htaccess` rules are compatible

### Slow Initial Response
- First request is slower (cold start)
- Subsequent requests are fast
- Vercel keeps functions warm for ~10 minutes

## Post-Deployment

1. **Update APP_URL:**
   - Get your final Vercel domain
   - Update `APP_URL` in Vercel environment variables
   - Redeploy

2. **Set Up Custom Domain:**
   - In Vercel dashboard → Settings → Domains
   - Add your custom domain
   - Update DNS records

3. **Enable Auto-Deployments:**
   - Each push to main branch automatically deploys
   - Configure in Vercel dashboard

4. **Set Up Monitoring:**
   - Enable Vercel Analytics
   - Set up error tracking (Sentry, etc.)
   - Monitor database performance

## Important Notes

⚠️ **Filesystem is Ephemeral:**
- Files uploaded to `/tmp` are deleted after the function completes
- Use S3 or external storage for persistent files
- Database is the only persistent storage

⚠️ **Cold Starts:**
- First request after 15 mins is slower (~1-2s)
- Vercel keeps 6+ functions warm by default
- Consider upgrading to Pro for better performance

⚠️ **Environment Variables:**
- Never commit `.env` file
- Always set sensitive variables in Vercel dashboard
- Use `vercel env pull` to test locally with production values

## Success Checklist

- [ ] Database provider chosen and set up
- [ ] All environment variables configured in Vercel
- [ ] Code pushed to GitHub/GitLab
- [ ] Initial deployment completed
- [ ] Migrations run successfully
- [ ] Database connectivity verified
- [ ] At least one page loads without errors
- [ ] Logs show no PHP errors

## Need Help?

- Vercel Docs: https://vercel.com/docs
- Laravel Docs: https://laravel.com/docs
- Community Issues: https://github.com/search?q=vercel+laravel
