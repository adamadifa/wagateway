# Phonebook API Documentation

API ini menyediakan endpoint untuk mengelola phonebook dan grup WhatsApp dari device yang terhubung.

## Base URL
```
{your-domain}/api/{locale}/
```

## Authentication
Semua endpoint memerlukan API Key yang valid melalui parameter `api_key`.

## Endpoints

### 1. Fetch Groups from Device
Mengambil grup WhatsApp dari device yang terhubung dan menyimpannya ke phonebook.

**Endpoint:** `POST /api-fetch-groups`

**Parameters:**
```json
{
    "number": "6281234567890",
    "api_key": "your-api-key"
}
```

**Response Success:**
```json
{
    "status": true,
    "message": "Groups fetched successfully",
    "data": {
        "groups": [
            {
                "group_id": "120363123456789012@g.us",
                "group_name": "Nama Grup",
                "tag_id": 1,
                "tag_name": "Nama Grup (ID: 120363123456789012@g.us)",
                "participants_count": 5,
                "contacts": [
                    {
                        "id": 1,
                        "tag_id": 1,
                        "name": "6281234567890",
                        "number": "6281234567890",
                        "created_at": "2024-01-01T00:00:00.000000Z"
                    }
                ]
            }
        ],
        "total_groups": 1,
        "device_number": "6281234567890",
        "device_name": "6281234567890"
    }
}
```

**Response Error:**
```json
{
    "status": false,
    "message": "Device is not connected"
}
```

### 2. Get Phonebook Data
Mengambil data phonebook dengan pagination dan search.

**Endpoint:** `GET/POST /api-phonebook`

**Parameters:**
```json
{
    "api_key": "your-api-key",
    "search": "nama grup", // optional
    "per_page": 15 // optional, default 15
}
```

**Response Success:**
```json
{
    "status": true,
    "message": "Phonebook data retrieved successfully",
    "data": {
        "phonebooks": [
            {
                "id": 1,
                "name": "Nama Grup (ID: 120363123456789012@g.us)",
                "created_at": "2024-01-01T00:00:00.000000Z",
                "contacts": [
                    {
                        "id": 1,
                        "tag_id": 1,
                        "name": "6281234567890",
                        "number": "6281234567890",
                        "created_at": "2024-01-01T00:00:00.000000Z"
                    }
                ]
            }
        ],
        "pagination": {
            "current_page": 1,
            "last_page": 1,
            "per_page": 15,
            "total": 1,
            "from": 1,
            "to": 1
        }
    }
}
```

### 3. Clear Phonebook
Menghapus semua data phonebook.

**Endpoint:** `POST /api-clear-phonebook`

**Parameters:**
```json
{
    "api_key": "your-api-key"
}
```

**Response Success:**
```json
{
    "status": true,
    "message": "Phonebook cleared successfully"
}
```

### 4. Get Group Contacts
Mengambil kontak dari grup tertentu.

**Endpoint:** `GET/POST /api-group-contacts`

**Parameters:**
```json
{
    "tag_id": 1,
    "api_key": "your-api-key"
}
```

**Response Success:**
```json
{
    "status": true,
    "message": "Group contacts retrieved successfully",
    "data": {
        "group": {
            "id": 1,
            "name": "Nama Grup (ID: 120363123456789012@g.us)",
            "created_at": "2024-01-01T00:00:00.000000Z"
        },
        "contacts": [
            {
                "id": 1,
                "tag_id": 1,
                "name": "6281234567890",
                "number": "6281234567890",
                "created_at": "2024-01-01T00:00:00.000000Z"
            }
        ],
        "total_contacts": 1
    }
}
```

## Error Codes

| Code | Description |
|------|-------------|
| 400 | Bad Request - Parameter tidak valid atau device tidak terhubung |
| 404 | Not Found - Device atau grup tidak ditemukan |
| 500 | Internal Server Error - Terjadi kesalahan server |

## Contoh Penggunaan dengan cURL

### Fetch Groups
```bash
curl -X POST "https://your-domain.com/api/en/api-fetch-groups" \
  -H "Content-Type: application/json" \
  -d '{
    "number": "6281234567890",
    "api_key": "your-api-key"
  }'
```

### Get Phonebook
```bash
curl -X GET "https://your-domain.com/api/en/api-phonebook?api_key=your-api-key&search=nama%20grup"
```

### Clear Phonebook
```bash
curl -X POST "https://your-domain.com/api/en/api-clear-phonebook" \
  -H "Content-Type: application/json" \
  -d '{
    "api_key": "your-api-key"
  }'
```

### Get Group Contacts
```bash
curl -X GET "https://your-domain.com/api/en/api-group-contacts?tag_id=1&api_key=your-api-key"
```

## Catatan Penting

1. **Device Status**: Pastikan device dalam status "Connected" sebelum melakukan fetch groups
2. **Cache**: Data groups di-cache selama 60 menit untuk performa yang lebih baik
3. **Rate Limiting**: Hindari melakukan fetch groups terlalu sering
4. **API Key**: Pastikan API key valid dan memiliki akses ke device yang diminta
5. **Locale**: Ganti `{locale}` dengan bahasa yang diinginkan (en, id, dll)
