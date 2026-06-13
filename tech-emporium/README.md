# Tech Emporium - Premium Electronics E-Commerce Store

**Tech Emporium** is a premium, state-of-the-art e-commerce frontend interface built for computer hardware, laptops, and accessories, specifically localized for the Pakistani market. 

---

## 🎨 Design Theme & Colors
Inspired by modern high-end electronics stores:
* **Dark Navy Blue** (`#0a1128`) - Core backdrop
* **Electric Blue** (`#0066ff`) - Brand accents and links
* **White** (`#ffffff`) - Clear primary text
* **Light Gray** (`#f4f6f9`) - Secondary components
* **Orange Accent** (`#ff9900`) - Pricing highlights and primary highlights
* **Features:** Glassmorphism (`backdrop-filter`), smooth hover zoom effects, responsive grids, sleek gradients, back-to-top, and a smooth loader.

---

## ⚙️ Technology Stack
* **HTML5** & **CSS3** (Custom style rules)
* **Bootstrap 5** (Layout grid & accordion components)
* **Bootstrap Icons** (CDN vector graphics)
* **JavaScript** (Core logic & data management)
* **Client-Side Storage:** Full support for `localStorage` enabling active Cart item calculations, Wishlist toggles, order placement logging, and settings saving.
* **PKR (Pakistani Rupees)** currency throughout the catalog.

---

## 📁 Project Directory Structure
```plaintext
TechEmporium/
│
├── index.html            # Home page (9 key marketing sections)
├── products.html         # Interactive search, sorting, & filtration catalog
├── product-details.html   # Product description, specs, review tabs, recommendations
├── categories.html       # Visual directory for categories
├── cart.html             # Cart totals, item quantities adjustments, removals
├── checkout.html         # Billing data validation & payment selection
├── wishlist.html         # Favorite items checklist management
├── login.html            # Glassmorphic user login interface
├── register.html         # Onboarding signup checks
├── my-account.html       # Customer stats dashboard, profile & address settings
├── orders.html           # Placed orders tracker & success banners
├── about.html            # Mission, vision, & leadership profile cards
├── contact.html          # Contact form & styled map indicators
├── faq.html              # Accordion support lists (policies, shipping, warranties)
│
├── assets/
│   ├── css/
│   │   └── style.css     # Design system, core animations, glass variables
│   │
│   ├── js/
│   │   └── app.js        # JavaScript database, cart & wishlist logic, filtering
│   │
│   └── images/           # Local SVG illustrations & avatars
│       ├── banners/
│       ├── laptops/
│       ├── accessories/
│       ├── brands/
│       ├── testimonials/
│       └── team/
│
└── README.md
```

---

## 🚀 How to Run Locally
Since this is a static site with no heavy build systems or database requirements:
1. Open any `.html` page in your web browser (e.g. double-click `index.html`).
2. Alternatively, run a simple local server in the project directory:
   ```bash
   # Python
   python -m http.server 8000
   
   # NodeJS
   npx serve .
   ```
3. Navigate to `http://localhost:8000` (or the server port provided).

---

## 🛒 Interactive Features Enabled
* **Global Search:** Type keywords in any navbar search bar, and get matching results instantly on the catalog page.
* **Catalog Filters:** Dynamically filter by Categories (Checkboxes), Brands (Checkboxes), Price ranges (Slider), or Sort by price/rating without page reloads.
* **Persistent Cart:** Add items on the homepage or detail page, increase/decrease quantities in the cart, and watch counters and total amounts update in real-time.
* **Persistent Wishlist:** Toggle favorites on product cards, manage them in a dedicated card grid, and move them directly to the cart.
* **Simulated Checkout:** Complete shipping credentials, select cash/wallet payment modes, and register orders to the permanent account logs.
* **Account Settings:** Edit contact numbers, receiver details, or clear order histories.
