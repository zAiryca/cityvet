flowchart TD
A([Start: User opens the CityVet Pet Management System website in their browser]) --> B[/"User chooses to register a new account<br/>Fills out the registration form with personal details like name, email, password, contact info<br/>System validates the input (e.g., checks if email is unique, password meets requirements)<br/>If validation passes, saves the new user information in the system database<br/>User receives a confirmation email for account verification"/]
B --> C[/User logs in with their email and password<br/>System checks the credentials against stored user data<br/>If valid, grants access and starts a session; if not, shows an error message like 'Invalid credentials'/]
C --> D{System checks the user's role<br/>Is the user an Admin?}
D -->|Yes| E["Admin is redirected to the Admin Dashboard<br/>Dashboard displays an overview of system statistics, such as total number of pets, pending requests, active users<br/>Admin can access administrative functions from the menu"]
D -->|No| F["Regular user is redirected to the User Dashboard<br/>Dashboard shows the user's own pets, submitted requests, created posters, and pet registrations<br/>User can access personal functions from the menu"]
E --> G{Admin selects an action from the menu<br/>What does the admin want to do?}
G -->|Manage Users| H[/"Admin views a list of all registered users<br/>Can create a new user account, edit existing user details, delete a user, or view detailed user information<br/>All changes are saved and may trigger notifications"/]
G -->|Manage Announcements| I[/"Admin views a list of announcements<br/>Can create new announcements (e.g., events or news), edit existing ones, delete announcements, or publish/unpublish them<br/>Updates are saved and become visible to users"/]
G -->|Manage Pets| J[/"Admin views a list of all pets in the system<br/>Can add new pets that need homes or are stray, edit pet details, update pet status (e.g., change from 'stray' to 'available for adoption')<br/>Changes may trigger notifications to users or update related requests"/]
G -->|Manage Requests| K[/"Admin views pending adoption or claim requests<br/>Can approve or reject requests<br/>Approved requests update the pet's status (e.g., to 'adopted') and notify the requester via email<br/>Rejected requests are marked and the user is notified with reasons"/]
G -->|Generate Reports| L[/"Admin selects a report type (e.g., adoption statistics, user activity)<br/>System gathers data from various sources<br/>Generates and displays the report, which can be exported as PDF or CSV"/]
F --> M{User selects an action from the menu<br/>What does the user want to do?}
M -->|View Pets| N[/"User browses available pets<br/>Can filter pets by type (e.g., dog, cat), status (stray, available), or location<br/>Views detailed pet information, photos, and description<br/>Can submit a request to adopt a specific pet from this page"/]
M -->|Create Poster| O[/"User fills out a poster form for a lost or found pet<br/>Uploads photos, enters details like pet name, location last seen/found, reward amount<br/>System saves the poster and sets it to 'pending' for review<br/>User can view and edit their posters later"/]
M -->|Submit Request| P[/"User selects a pet and fills out a request form (e.g., reason for adoption, contact info)<br/>System saves the request linked to the pet<br/>Admin is notified for review<br/>User can track the request status"/]
M -->|Manage Registration| Q[/"User views their pet registrations<br/>Can create a new registration for an owned pet, edit existing details, or delete a registration<br/>Changes are saved<br/>This helps in official pet ownership records"/]
H --> R((End: Admin logs out or continues using the system<br/>Session ends, data is saved))
I --> R
J --> R
K --> R
L --> R
N --> R
O --> R
P --> R
Q --> R
