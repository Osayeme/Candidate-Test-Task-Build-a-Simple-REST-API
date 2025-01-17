# Debugging Report

## Overview
This report documents the issues encountered during the development of the project, the debugging process, and the resolutions.

---

### 1. Issue: Middleware Error
**Error Message:**

**Cause:**
The `PostController` class was incorrectly using the `middleware` method, which is not available in base controllers.

**Resolution:**
Removed the `middleware` method in the `PostController` constructor and instead applied the `auth:api` middleware directly in the routes file.

---

### 2. Issue: Route [login] Not Defined
**Error Message:**

**Cause:**
The `auth:api` middleware was being applied to routes incorrectly. The `login` route should not require authentication.

**Resolution:**
Adjusted the `routes/web.php` file to ensure that the `auth:api` middleware is only applied to routes that need authentication.

---

### 3. Issue: JWT Contract Error
**Error Message:**

**Cause:**
The `User` model did not fully implement the `Tymon\JWTAuth\Contracts\JWTSubject` interface.

**Resolution:**
Added the missing `getJWTCustomClaims` method to the `User` model.

---

### 4. Issue: Dubious Ownership in Git
**Error Message:**

**Cause:**
The project was initialized in a directory where Git ownership was not trusted.

**Resolution:**
Ran the following command to trust the directory:
