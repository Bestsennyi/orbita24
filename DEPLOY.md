# Orbita24 Deployment

Orbita24 is deployed as a normal PHP/HTML/CSS/JS website to regular IONOS hosting. Deploy Now is not used.

## Branch Workflow

- `dev` is for local development and testing.
- `main` is the production branch.
- Only pushes to `main` trigger the SFTP deployment workflow.
- Pushes to `dev` do not deploy anything.

Recommended flow:

1. Work locally in `dev`.
2. Check the site and contact form changes.
3. Merge `dev` into `main`.
4. Push `main` to GitHub.
5. GitHub Actions uploads the site to IONOS by SFTP on port `22`.

## GitHub Secrets

The workflow keeps the existing secret names:

- `FTP_SERVER`: IONOS SFTP host.
- `FTP_USERNAME`: IONOS SFTP user.
- `FTP_PASSWORD`: IONOS SFTP password.
- `FTP_SERVER_DIR`: target directory on IONOS.

For this project the server root is:

```text
/
```

So `FTP_SERVER_DIR` should be set to `/`.

## Deployed Path

The website root is the repository root. The workflow uploads from:

```text
./
```

This is correct because `index.html`, `kontakt.php`, `.htaccess`, `css/`, `js/`, `images/`, `includes/`, and `optionen/` are directly in the project root.

There is no frontend build step. The workflow uploads the working PHP/HTML/CSS/JS files as they are.

## Deployment Method

The workflow file is:

```text
.github/workflows/deploy.yml
```

It installs `lftp` on the GitHub Actions runner and uses SFTP:

- protocol: `SFTP`
- port: `22`
- remote path: value of `FTP_SERVER_DIR`, expected `/`

The deploy command uses `mirror --reverse --only-newer`. It uploads changed/newer local files to the server and does not perform a destructive full cleanup.

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

Site files such as `.html`, `.php`, `.htaccess`, `css/**`, `js/**`, `images/**`, `assets/**` if added later, `includes/**`, and `optionen/**` are uploaded.

## First Deployment Notes

The workflow does not use FTP/FTPS and does not use Deploy Now.

Before the first production push, confirm that `FTP_SERVER_DIR` is exactly `/` for this IONOS account and domain. A wrong target directory can upload the site to the wrong place or mix it with another website.

After the first deployment, check:

- `https://orbita24.de/`
- `https://orbita24.de/kontakt.php`
- CSS, JavaScript, logo, favicon, and option pages
- contact form submission
- that `includes/config.php` and `includes/contact-handler.php` are not directly accessible in the browser
