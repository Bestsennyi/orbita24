# Orbita24 Deployment

Orbita24 is deployed as a normal PHP/HTML/CSS/JS website to regular IONOS hosting. Deploy Now is not used.

## Branch Workflow

- `dev` is for local development and testing.
- `main` is the production branch.
- Only pushes to `main` trigger the FTP deployment workflow.
- Pushes to `dev` do not deploy anything.

Recommended flow:

1. Work locally in `dev`.
2. Check the site and contact form changes.
3. Merge `dev` into `main`.
4. Push `main` to GitHub.
5. GitHub Actions uploads the site to IONOS by FTPS.

## GitHub Secrets

Add these repository secrets in GitHub:

- `FTP_SERVER`: IONOS FTP/FTPS host, for example `home123456789.1and1-data.host`.
- `FTP_USERNAME`: IONOS FTP user.
- `FTP_PASSWORD`: IONOS FTP password.
- `FTP_SERVER_DIR`: target directory on IONOS, with a trailing slash.

Examples for `FTP_SERVER_DIR` depend on the IONOS package and domain mapping:

- `./`
- `/`
- `/clickandbuilds/orbita24/`
- `/kunden/homepages/xx/xxxxxxxxx/htdocs/`

Use the directory that is assigned to the live domain in the IONOS hosting panel.

## Deployed Path

The website root is the repository root. The workflow uploads from:

```text
./
```

This is correct because `index.html`, `kontakt.php`, `.htaccess`, `css/`, `js/`, `images/`, `includes/`, and `optionen/` are directly in the project root.

There is no frontend build step. The workflow uploads the working PHP/HTML/CSS/JS files as they are.

## Excluded From Upload

The workflow excludes development and repository files, including:

- `.git/**`
- `.github/**`
- `.vscode/**`
- `node_modules/**`
- `vendor/**`
- `.env`
- `.env.*`
- `.ftp-deploy-sync-state.json`
- `.DS_Store`
- `Thumbs.db`
- `*.log`
- `*.bak`
- `*.tmp`
- `*.swp`
- `*~`
- `README.md`
- `DEPLOY.md`
- `HOSTING-READY.md`
- `.gitignore`

Site files such as `.html`, `.php`, `.htaccess`, `css/**`, `js/**`, `images/**`, `assets/**` if added later, and `optionen/**` are uploaded.

## First Deployment Notes

The FTP action uses `dangerous-clean-slate: false`, so it does not wipe the whole target directory before upload. This is safer for the first deployment.

Before the first production push, make sure `FTP_SERVER_DIR` points to the correct IONOS web root for the domain. A wrong target directory can upload the site to the wrong place or mix it with another website.

After the first deployment, check:

- `https://orbita24.de/`
- `https://orbita24.de/kontakt.php`
- CSS, JavaScript, logo, favicon, and option pages
- contact form submission
- that `includes/config.php` and `includes/contact-handler.php` are not directly accessible in the browser
