# Created by Jeff Paine
# https://gist.github.com/JeffPaine
# Thanks
import json
import requests
import sys

# Authentication for user filing issue (must have read/write access to
# repository to add issue to)

title = sys.argv[1]
body = sys.argv[2]
USERNAME = sys.argv[3]
PASSWORD = sys.argv[4]

# The repository to add this issue to
REPO_OWNER = 'SelectiveAlso'
REPO_NAME = 'mbcdb'

def make_github_issue(title, body=None, assignee=None, milestone=None, labels=None):
    '''Create an issue on github.com using the given parameters.'''
    # Our url to create issues via POST
    url = 'https://api.github.com/repos/%s/%s/issues' % (REPO_OWNER, REPO_NAME)
    # Create an authenticated session to create the issue
    session = requests.Session()
    session.auth = (USERNAME, PASSWORD)
    # Create our issue
    issue = {'title': title,
             'body': body,
             'assignee': assignee,
             'milestone': milestone,
             'labels': labels}
    # Add the issue to our repository
    r = session.post(url, json.dumps(issue))
    if r.status_code == 201:
        print 'Successfully created Issue "%s"' % title
    else:
        print 'Could not create Issue "%s"' % title
        print 'Response:', r.content


make_github_issue(title, body, "SelectiveAlso", None, ['bug'])