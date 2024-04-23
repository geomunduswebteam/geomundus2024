from googleapiclient.discovery import build
from googleapiclient.http import MediaIoBaseDownload
from google.oauth2 import service_account
import io

client_id = '892748311642-uive10rq7nsi55ajiu42r0tpkpaftfp6.apps.googleusercontent.com'
client_secret = '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'
AUTH_URL = 'https://accounts.google.com/o/oauth2/auth'



'''
credentials = service_account.Credentials.from_service_account_info(credz)
drive_service = build('drive', 'v3', credentials=credentials)

file_id = '0BwwA4oUTeiV1UVNwOHItT0xfa2M'
request = drive_service.files().get_media(fileId=file_id)
#fh = io.BytesIO() # this can be used to keep in memory
fh = io.FileIO('file.tar.gz', 'wb') # this can be used to write to disk
downloader = MediaIoBaseDownload(fh, request)
done = False
while done is False:
    status, done = downloader.next_chunk()
    print("Download %d%%." % int(status.progress() * 100))
'''