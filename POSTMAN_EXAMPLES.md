# Postman Examples untuk Phonebook API

## Setup Postman

### Base URL
```
http://localhost:8000/api/en
```

### Headers (untuk semua request)
```
Content-Type: application/json
Accept: application/json
```

---

## 1. Fetch Groups from Device

**Method:** `POST`
**URL:** `http://localhost:8000/api/en/api-fetch-groups`

**Body (raw JSON):**
```json
{
    "number": "6281234567890",
    "api_key": "your-api-key-here"
}
```

**Expected Response:**
```json
{
    "status": true,
    "message": "Groups fetched successfully",
    "data": {
        "groups": [
            {
                "id": 1,
                "name": "Group Name",
                "participant_count": 5,
                "created_at": "2024-01-01T00:00:00.000000Z"
            }
        ],
        "total_groups": 1,
        "device_number": "6281234567890",
        "device_name": "6281234567890"
    }
}
```

---

## 2. Get Phonebook Data

**Method:** `GET`
**URL:** `http://localhost:8000/api/en/api-phonebook`

**Query Parameters:**
```
api_key: your-api-key-here
page: 1
per_page: 10
search: (optional)
```

**Full URL Example:**
```
http://localhost:8000/api/en/api-phonebook?api_key=your-api-key-here&page=1&per_page=10
```

**Expected Response:**
```json
{
    "status": true,
    "message": "Phonebook data retrieved successfully",
    "data": {
        "groups": [
            {
                "id": 1,
                "name": "Group Name",
                "participant_count": 5,
                "created_at": "2024-01-01T00:00:00.000000Z"
            }
        ],
        "pagination": {
            "current_page": 1,
            "per_page": 10,
            "total": 1,
            "last_page": 1,
            "from": 1,
            "to": 1
        }
    }
}
```

---

## 3. Clear Phonebook

**Method:** `POST`
**URL:** `http://localhost:8000/api/en/api-clear-phonebook`

**Body (raw JSON):**
```json
{
    "api_key": "your-api-key-here"
}
```

**Expected Response:**
```json
{
    "status": true,
    "message": "Phonebook cleared successfully",
    "data": {
        "deleted_groups": 5,
        "deleted_contacts": 25
    }
}
```

---

## 4. Get Group Contacts

**Method:** `GET`
**URL:** `http://localhost:8000/api/en/api-group-contacts`

**Query Parameters:**
```
api_key: your-api-key-here
group_id: 1
page: 1
per_page: 10
```

**Full URL Example:**
```
http://localhost:8000/api/en/api-group-contacts?api_key=your-api-key-here&group_id=1&page=1&per_page=10
```

**Expected Response:**
```json
{
    "status": true,
    "message": "Group contacts retrieved successfully",
    "data": {
        "group": {
            "id": 1,
            "name": "Group Name",
            "participant_count": 5
        },
        "contacts": [
            {
                "id": 1,
                "name": "Contact Name",
                "phone": "6281234567890",
                "created_at": "2024-01-01T00:00:00.000000Z"
            }
        ],
        "pagination": {
            "current_page": 1,
            "per_page": 10,
            "total": 5,
            "last_page": 1,
            "from": 1,
            "to": 5
        }
    }
}
```

---

## Error Responses

### 401 Unauthorized
```json
{
    "status": false,
    "message": "Invalid API key"
}
```

### 404 Not Found
```json
{
    "status": false,
    "message": "Device not found or not authorized"
}
```

### 400 Bad Request
```json
{
    "status": false,
    "message": "Device is not connected"
}
```

### 500 Internal Server Error
```json
{
    "status": false,
    "message": "Something went wrong: [error details]"
}
```

---

## Tips untuk Postman

1. **Environment Variables:**
   - Buat environment variable untuk `base_url`: `http://localhost:8000/api/en`
   - Buat variable untuk `api_key`: `your-api-key-here`

2. **Collection Setup:**
   - Buat collection "Phonebook API"
   - Tambahkan semua 4 endpoint di atas
   - Set environment variables untuk semua request

3. **Testing:**
   - Pastikan server Laravel berjalan di port 8000
   - Ganti `your-api-key-here` dengan API key yang valid
   - Ganti `6281234567890` dengan nomor device yang valid dan terhubung

4. **Pre-request Script (Optional):**
   ```javascript
   // Untuk auto-generate timestamp jika diperlukan
   pm.globals.set("timestamp", new Date().toISOString());
   ```
