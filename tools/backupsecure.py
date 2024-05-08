from pydrive.auth import GoogleAuth
from pydrive.drive import GoogleDrive
import os
from zipfile import ZipFile
import mimetypes

# Function to export Google Docs to MS Office format
def export_to_ms_office(file):
    mime_type = mimetypes.guess_type(file['title'])[0]
    if mime_type == 'application/vnd.google-apps.document':
        download_url = file['exportLinks']['application/vnd.openxmlformats-officedocument.wordprocessingml.document']
    elif mime_type == 'application/vnd.google-apps.spreadsheet':
        download_url = file['exportLinks']['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
    elif mime_type == 'application/vnd.google-apps.presentation':
        download_url = file['exportLinks']['application/vnd.openxmlformats-officedocument.presentationml.presentation']
    else:
        return None

    resp, content = drive.auth.service._http.request(download_url)
    return content

# Authenticate and create PyDrive client
gauth = GoogleAuth()
gauth.DEFAULT_SETTINGS['client_config_file'] = 'client_secrets.json'
gauth.DEFAULT_SETTINGS['oauth_scope'] = [
    'https://www.googleapis.com/auth/drive',
    'https://www.googleapis.com/auth/drive.file',
    'https://www.googleapis.com/auth/drive.metadata'
]
gauth.DEFAULT_SETTINGS['client_id'] = '892748311642-uive10rq7nsi55ajiu42r0tpkpaftfp6.apps.googleusercontent.com'
gauth.DEFAULT_SETTINGS['client_secret'] = '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'
gauth.CommandLineAuth()
drive = GoogleDrive(gauth)

# Google Drive folder link
folder_link = 'https://drive.google.com/drive/folders/14si8RQc7_oQo89el__iZKj9QylNe4fZS'

# Destination directory
destination_dir = r'C:\Users\Bachi\Downloads\Geomundus_Backups'

# Create a folder for the files
if not os.path.exists(destination_dir):
    os.makedirs(destination_dir)

# Function to download and export files
def download_files_from_folder(folder_id, destination):
    file_list = drive.ListFile({'q': f"'{folder_id}' in parents and trashed=false"}).GetList()
    for file in file_list:
        if file['mimeType'] == 'application/vnd.google-apps.folder':
            subfolder_path = os.path.join(destination, file['title'])
            os.makedirs(subfolder_path, exist_ok=True)
            download_files_from_folder(file['id'], subfolder_path)
        else:
            content = export_to_ms_office(file)
            if content:
                with open(os.path.join(destination, f"{file['title'].rsplit('.', 1)[0]}.docx"), 'wb') as f:
                    f.write(content)

# Download files from the specified folder
download_files_from_folder('14si8RQc7_oQo89el__iZKj9QylNe4fZS', destination_dir)

# Zip the downloaded files
def zip_dir(folder_path, zip_path):
    with ZipFile(zip_path, 'w') as zip_file:
        for root, dirs, files in os.walk(folder_path):
            for file in files:
                zip_file.write(os.path.join(root, file), os.path.relpath(os.path.join(root, file), os.path.join(folder_path, '..')))

zip_dir(destination_dir, os.path.join(destination_dir, 'Geomundus_Backups.zip'))

print("Folder downloaded and zipped successfully!")
