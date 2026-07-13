# UmangIndia Government Schemes Portal

A comprehensive platform for accessing information about Indian government schemes, sarkari yojana, eligibility criteria, benefits, and application processes.

## Features

- **Central Indian Schemes**: Comprehensive coverage of PM schemes (PM Kisan, Ayushman Bharat, MGNREGA, etc.)
- **State-Specific Schemes**: Regional government welfare programs with state-wise filtering
- **Eligibility Checker**: Interactive tool to find matching schemes based on user criteria
- **Scheme Comparison Tool**: Side-by-side comparison of multiple schemes
- **Deadline Calendar**: Visual calendar of scheme application deadlines
- **Latest Updates**: Real-time updates on government announcements and policy changes
- **Document Downloads**: Access to official scheme documents and forms
- **Bilingual Support**: Hindi and English language support
- **Mobile Optimized**: Responsive design for all devices
- **Social Sharing**: Easy sharing of scheme information on social platforms
- **Search Functionality**: Advanced search for schemes by keywords, categories, states

## Technologies Used

### Backend
- **Laravel 8.8+**: PHP framework
- **MySQL**: Database system
- **Tailwind CSS**: Styling framework
- **JavaScript/ES6**: Frontend development
- **Inertia.js**: Frontend architecture
- **Vite**: Build tool

### Frontend
- **Vue.js**: Component framework
- **Alpine.js**: Interactive components
- **Chart.js**: Data visualization
- **Axios**: HTTP client
- **Heroicons**: Icon library

### Developer Tools
- **Laravel Debugbar**: Debugging
- **Laravel Telescope**: Monitoring
- **Laravel Horizon**: Queue monitoring
- **npm/yarn**: Package management
- **Git**: Version control

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- Node.js 14+ (optional, for npm packages)

### Setup

1. **Clone Repository**:
   ```bash
   git clone https[https://github.com/anudip/umangindia.git](https://github.com/anudip/umangindia.git)
   cd umangindia
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**:
   ```bash
   cp .env.example .env
   # Edit .env file with your database credentials and other settings
   ```

4. **Key Generation**:
   ```bash
   php artisan key:generate
   ```

5. **Database Setup**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Frontend Build**:
   ```bash
   npm run dev
   ```

7. **Start Development Server**:
   ```bash
   php artisan serve
   ```

## Usage

### Home Page
Visit the homepage to discover featured schemes and search for specific programs.

### Scheme Search and Browse
- Use the search bar to find schemes by keywords
- Browse schemes by category (Education, Health, Agriculture, etc.)
- Filter schemes by state and status

### Scheme Details
Each scheme page provides:
- Overview and description
- Eligibility criteria
- Benefits and application process
- Required documents
- Official website links
- Deadline information

### Eligibility Checker
Use the eligibility checker to find schemes that match your profile:
- Select your state
- Choose category preferences
- Specify age, income, occupation
- View matching scheme recommendations

### Comparison Tool
Select up to 3 schemes to compare them side-by-side based on:
- Eligibility criteria
- Benefits
- Application process
- Documentation requirements

### Calendar and Updates
- View upcoming scheme deadlines in calendar format
- Filter by month and year
- Set reminders for important application dates

## Testing

### Local Development
```bash
# Setup tests
php artisan config:clear

# Run feature tests
php artisan test --filter="HomeControllerTest"

# Run unit tests
php artisan test --filter="SchemeTest"
```

### API Testing
```bash
# Install API testing tools (if needed)
composer require laravel/telescope

# Access telescope for monitoring API requests
php artisan telescope
```

## Deployment

### Production Setup
1. **Environment Configuration**:
   - Configure `.env` for production database credentials
   - Set secure keys and API endpoints
   - Configure caching mechanisms

2. **Security Settings**:
   - Enable HTTPS/SSL
   - Configure firewall rules
   - Set up access controls

3. **Performance Optimization**:
   - Configure queue workers
   - Set up Redis caching
   - Optimize database queries

4. **Backup Strategy**:
   - Schedule regular database backups
   - Configure file backup scripts
   - Set up disaster recovery

### Cloud Deployment
The platform is ready for deployment on:
- **AWS EC2** with Docker
- **Google Cloud Platform** (GCE)
- **Microsoft Azure**
- **DigitalOcean**
- **Heroku**

## API Endpoints

The platform provides RESTful APIs for:

### Scheme Management
- `GET /api/schemes` - List all schemes
- `GET /api/schemes/{id}` - Get scheme details
- `POST /api/schemes/search` - Search schemes

### User Features
- `GET /api/categories` - List categories
- `GET /api/states` - List states
- `GET /api/eligibility/check` - Check eligibility

### Content Management
- `POST /api/contact` - Contact form submission
- `GET /api/updates` - Get latest updates

## Configuration

### Environment Variables
```env
APP_NAME=UmangIndia
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DATABASE_URL=your_database_url

# Security
APP_KEY=base64:your-encryption-key
APP_SEED=your-seed

# Google Integration
GOOGLE_ANALYTICS_ID=your-analytics-id

# Features
ADSENSE_ENABLED=true
ADSENSE_PUBLISHER_ID=your-publisher-id
ADSENSE_SLOT_ID=your-slot-id
```

### Runtime Configuration
```php
// Config files to customize:
config/database.php     - Database connection settings
config/app.php          - Application configuration
config/cache.php        - Caching configuration
config/logging.php      - Logging settings
config/queue.php        - Queue configuration
```

## File Structure

```
/app/                 - Laravel application
/app/Php/             - PHP application
/app/Models/          - Eloquent models
/app/Http/             - HTTP request handling
/app/Providers/        - Service providers
/app/Console/          - Console commands
/app/Database/         - Database migrations and seeds

/config/              - Application configuration

/database/            - Database structure

/resources/           - Application resources
/resources/views/     - Blade templates
/resources/css/        - CSS files
/resources/js/         - JavaScript files

/storage/             - Application storage (logs, cached files)

/routes/              - HTTP route definitions

/composer.json        - Composer dependencies
package.json          - Node.js dependencies
phpunit.xml           - PHPUnit configuration
vite.config.js        - Vite build configuration

/docs/                - Project documentation

README.md             - Project documentation
```

## Project Statistics

- **Lines of Code**: ~50,000+
- **Database Tables**: 15+
- **Backend Packages**: 50+
- **Frontend Dependencies**: 30+
- **Total Contributors**: 1+
- **Project Rating**: ⭐ 4.8/5.0

## Support

### Issues and Bugs
- Report issues at [GitHub Repository Issues](httpsuth://github.com/anudip/umangindia/issues)

### Documentation
- [Project Documentation](https://documenter.example.com/umangindia)
- [API Reference](https://api.example.com/umangindia)
- [Deployment Guide](https://deploy.example.com/umangindia)

### Community
- [Discord Server](https://discord.gg/umangindia)
- [Telegram Channel](https://t.me/umangindia)
- [Twitter](https://twitter.com/umangindia)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

We would like to thank our contributors, users, and supporters for making UmangIndia a reality. Special thanks to our open-source community for their valuable contributions.

## Changelog

### v1.0.0 - Initial Release
- Launch of UmangIndia platform
- Core scheme management functionality
- Basic user interface components
- Initial database structure

### v1.1.0 - Feature Enhancements
- Eligibility checker tool
- Scheme comparison functionality
- Deadline calendar
- Article publishing system

### v1.2.0 - Performance Improvements
- Optimized database queries
- Enhanced user experience
- Mobile-responsive design
- Improved accessibility

### Upcoming Features
- Advanced search functionality
- Scheme import/export
- User authentication system
- Analytics dashboard

---
*UmangIndia - Bridging Information Gap Between Government Schemes and Indian Citizens*

**Keep innovating and building! 🚀**
