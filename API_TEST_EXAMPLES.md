# Contoh Penggunaan API Phonebook

## Test API dengan cURL

### 1. Fetch Groups dari Device
```bash
curl -X POST "http://localhost:8000/api/en/api-fetch-groups" \
  -H "Content-Type: application/json" \
  -d '{
    "number": "6281234567890",
    "api_key": "your-api-key-here"
  }'
```

### 2. Get Phonebook Data
```bash
curl -X GET "http://localhost:8000/api/en/api-phonebook?api_key=your-api-key-here&search=nama%20grup&per_page=10"
```

### 3. Clear Phonebook
```bash
curl -X POST "http://localhost:8000/api/en/api-clear-phonebook" \
  -H "Content-Type: application/json" \
  -d '{
    "api_key": "your-api-key-here"
  }'
```

### 4. Get Group Contacts
```bash
curl -X GET "http://localhost:8000/api/en/api-group-contacts?tag_id=1&api_key=your-api-key-here"
```

## Test dengan Postman

### Collection untuk Postman:
```json
{
  "info": {
    "name": "Phonebook API",
    "description": "API untuk mengelola phonebook dan grup WhatsApp"
  },
  "item": [
    {
      "name": "Fetch Groups",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n  \"device_id\": 1,\n  \"api_key\": \"your-api-key-here\"\n}"
        },
        "url": {
          "raw": "{{base_url}}/api/en/fetch-groups",
          "host": ["{{base_url}}"],
          "path": ["api", "en", "fetch-groups"]
        }
      }
    },
    {
      "name": "Get Phonebook",
      "request": {
        "method": "GET",
        "url": {
          "raw": "{{base_url}}/api/en/phonebook?api_key={{api_key}}&search=&per_page=15",
          "host": ["{{base_url}}"],
          "path": ["api", "en", "phonebook"],
          "query": [
            {
              "key": "api_key",
              "value": "{{api_key}}"
            },
            {
              "key": "search",
              "value": ""
            },
            {
              "key": "per_page",
              "value": "15"
            }
          ]
        }
      }
    },
    {
      "name": "Clear Phonebook",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n  \"api_key\": \"your-api-key-here\"\n}"
        },
        "url": {
          "raw": "{{base_url}}/api/en/clear-phonebook",
          "host": ["{{base_url}}"],
          "path": ["api", "en", "clear-phonebook"]
        }
      }
    },
    {
      "name": "Get Group Contacts",
      "request": {
        "method": "GET",
        "url": {
          "raw": "{{base_url}}/api/en/group-contacts?tag_id=1&api_key={{api_key}}",
          "host": ["{{base_url}}"],
          "path": ["api", "en", "group-contacts"],
          "query": [
            {
              "key": "tag_id",
              "value": "1"
            },
            {
              "key": "api_key",
              "value": "{{api_key}}"
            }
          ]
        }
      }
    }
  ],
  "variable": [
    {
      "key": "base_url",
      "value": "http://localhost:8000"
    },
    {
      "key": "api_key",
      "value": "your-api-key-here"
    }
  ]
}
```

## Test dengan JavaScript/Fetch

```javascript
// Fetch Groups
async function fetchGroups(deviceId, apiKey) {
  const response = await fetch('http://localhost:8000/api/en/fetch-groups', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      device_id: deviceId,
      api_key: apiKey
    })
  });
  
  return await response.json();
}

// Get Phonebook
async function getPhonebook(apiKey, search = '', perPage = 15) {
  const params = new URLSearchParams({
    api_key: apiKey,
    search: search,
    per_page: perPage
  });
  
  const response = await fetch(`http://localhost:8000/api/en/phonebook?${params}`);
  return await response.json();
}

// Clear Phonebook
async function clearPhonebook(apiKey) {
  const response = await fetch('http://localhost:8000/api/en/clear-phonebook', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      api_key: apiKey
    })
  });
  
  return await response.json();
}

// Get Group Contacts
async function getGroupContacts(tagId, apiKey) {
  const params = new URLSearchParams({
    tag_id: tagId,
    api_key: apiKey
  });
  
  const response = await fetch(`http://localhost:8000/api/en/group-contacts?${params}`);
  return await response.json();
}

// Contoh penggunaan
const apiKey = 'your-api-key-here';

// Fetch groups dari device
fetchGroups(1, apiKey).then(data => {
  console.log('Groups fetched:', data);
});

// Get phonebook data
getPhonebook(apiKey, 'nama grup').then(data => {
  console.log('Phonebook data:', data);
});

// Clear phonebook
clearPhonebook(apiKey).then(data => {
  console.log('Phonebook cleared:', data);
});

// Get group contacts
getGroupContacts(1, apiKey).then(data => {
  console.log('Group contacts:', data);
});
```

## Test dengan Python

```python
import requests
import json

# Base URL
BASE_URL = "http://localhost:8000/api/en"
API_KEY = "your-api-key-here"

def fetch_groups(device_id, api_key):
    url = f"{BASE_URL}/fetch-groups"
    data = {
        "device_id": device_id,
        "api_key": api_key
    }
    response = requests.post(url, json=data)
    return response.json()

def get_phonebook(api_key, search="", per_page=15):
    url = f"{BASE_URL}/phonebook"
    params = {
        "api_key": api_key,
        "search": search,
        "per_page": per_page
    }
    response = requests.get(url, params=params)
    return response.json()

def clear_phonebook(api_key):
    url = f"{BASE_URL}/clear-phonebook"
    data = {
        "api_key": api_key
    }
    response = requests.post(url, json=data)
    return response.json()

def get_group_contacts(tag_id, api_key):
    url = f"{BASE_URL}/group-contacts"
    params = {
        "tag_id": tag_id,
        "api_key": api_key
    }
    response = requests.get(url, params=params)
    return response.json()

# Contoh penggunaan
if __name__ == "__main__":
    # Fetch groups dari device
    groups = fetch_groups(1, API_KEY)
    print("Groups fetched:", groups)
    
    # Get phonebook data
    phonebook = get_phonebook(API_KEY, "nama grup")
    print("Phonebook data:", phonebook)
    
    # Clear phonebook
    cleared = clear_phonebook(API_KEY)
    print("Phonebook cleared:", cleared)
    
    # Get group contacts
    contacts = get_group_contacts(1, API_KEY)
    print("Group contacts:", contacts)
```

## Catatan Penting

1. **API Key**: Ganti `your-api-key-here` dengan API key yang valid dari user
2. **Device ID**: Pastikan device ID yang digunakan sudah terdaftar dan dalam status "Connected"
3. **Base URL**: Sesuaikan dengan domain aplikasi Anda
4. **Locale**: Ganti `en` dengan locale yang diinginkan (id, es, dll)
5. **Error Handling**: Selalu handle error response dari API
6. **Rate Limiting**: Hindari melakukan request terlalu sering
