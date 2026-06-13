/* ==========================================================================
   Tech Emporium - Premium E-Commerce Scripts
   ========================================================================== */

// --- PRODUCT CATALOG DATABASE ---
const PRODUCT_CATALOG = [
  {
    id: 1,
    name: "ASUS ROG Strix G16 (2024)",
    category: "laptops-gaming",
    brand: "asus",
    price: 389999,
    oldPrice: 419999,
    rating: 5,
    image: "assets/images/laptops/gaming-laptop.svg",
    badge: "Sale",
    badgeClass: "bg-danger",
    specs: {
      "Processor": "Intel Core i9-13980HX (24 Cores, Up to 5.6 GHz)",
      "RAM": "16GB DDR5 4800MHz (Upgradable)",
      "Storage": "1TB PCIe 4.0 NVMe M.2 SSD",
      "Graphics": "NVIDIA GeForce RTX 4070 8GB GDDR6",
      "Display": "16\" QHD+ (2560 x 1600) 240Hz ROG Nebula Display",
      "OS": "Windows 11 Home",
      "Warranty": "1 Year Local & International Warranty"
    },
    features: [
      "ROG Intelligent Cooling with liquid metal extreme",
      "Tri-Fan Tech and Full-Surround Vents",
      "MUX Switch with NVIDIA Advanced Optimus",
      "Dolby Vision & Dolby Atmos with Hi-Res Audio"
    ]
  },
  {
    id: 2,
    name: "Lenovo ThinkPad X1 Carbon Gen 11",
    category: "laptops-business",
    brand: "lenovo",
    price: 425000,
    oldPrice: 450000,
    rating: 5,
    image: "assets/images/laptops/business-laptop.svg",
    badge: "Best Seller",
    badgeClass: "bg-warning text-dark",
    specs: {
      "Processor": "Intel Core i7-1365U vPro (10 Cores, Up to 5.2 GHz)",
      "RAM": "32GB LPDDR5 6000MHz (Soldered)",
      "Storage": "1TB PCIe Gen4 NVMe Performance SSD",
      "Graphics": "Intel Iris Xe Graphics",
      "Display": "14\" WUXGA (1920 x 1200) IPS Anti-glare Touch 400 nits",
      "OS": "Windows 11 Pro",
      "Warranty": "3 Years Premier Support Warranty"
    },
    features: [
      "Ultralight carbon-fiber chassis (starting at 1.12kg)",
      "Military-grade standard testing (MIL-STD 810H)",
      "ThinkShield comprehensive security suite",
      "Zoom Certified communications with Quad Microphones"
    ]
  },
  {
    id: 3,
    name: "HP Pavilion Plus 14 (Ryzen 7)",
    category: "laptops-student",
    brand: "hp",
    price: 189999,
    oldPrice: 199999,
    rating: 4,
    image: "assets/images/laptops/student-laptop.svg",
    badge: "New",
    badgeClass: "bg-success",
    specs: {
      "Processor": "AMD Ryzen 7 7840U (8 Cores, Up to 5.1 GHz)",
      "RAM": "16GB LPDDR5x RAM",
      "Storage": "512GB PCIe NVMe M.2 SSD",
      "Graphics": "AMD Radeon 780M Graphics",
      "Display": "14\" 2.8K (2880 x 1800) OLED 120Hz 500 nits",
      "OS": "Windows 11 Home",
      "Warranty": "1 Year Brand Warranty"
    },
    features: [
      "Stunning 2.8K OLED display with HDR True Black 500",
      "All-metal aluminum chassis design",
      "HP True Vision 5MP IR Camera with shutter",
      "Fast charging: 50% in 30 minutes"
    ]
  },
  {
    id: 4,
    name: "Dell XPS 15 9530 Core i7",
    category: "laptops-business",
    brand: "dell",
    price: 385000,
    oldPrice: 399999,
    rating: 5,
    image: "assets/images/laptops/dell-xps.svg",
    badge: "Best Seller",
    badgeClass: "bg-warning text-dark",
    specs: {
      "Processor": "Intel Core i7-13700H (14 Cores, Up to 5.0 GHz)",
      "RAM": "16GB DDR5 4800MHz (Dual Channel)",
      "Storage": "1TB PCIe Gen4 NVMe M.2 SSD",
      "Graphics": "NVIDIA GeForce RTX 4050 6GB GDDR6",
      "Display": "15.6\" FHD+ (1920 x 1200) InfinityEdge Non-Touch 500 nits",
      "OS": "Windows 11 Home",
      "Warranty": "1 Year Dell Card Warranty"
    },
    features: [
      "InfinityEdge 4-sided display with 92.9% screen-to-body ratio",
      "CNC machined aluminum and carbon fiber palm rest",
      "Quad studio-grade speakers with Waves Nx 3D audio",
      "Massive 86Whr battery for long work hours"
    ]
  },
  {
    id: 5,
    name: "HP Spectre x360 14 2-in-1",
    category: "laptops-student",
    brand: "hp",
    price: 345000,
    oldPrice: 360000,
    rating: 5,
    image: "assets/images/laptops/hp-spectre.svg",
    badge: "New",
    badgeClass: "bg-success",
    specs: {
      "Processor": "Intel Core i7-1355U (10 Cores, Up to 5.0 GHz)",
      "RAM": "16GB LPDDR5 5200MHz",
      "Storage": "1TB PCIe NVMe M.2 SSD",
      "Graphics": "Intel Iris Xe Graphics",
      "Display": "13.5\" 3K2K (3000 x 2000) OLED Touch Screen with Stylus Pen",
      "OS": "Windows 11 Home",
      "Warranty": "1 Year International Warranty"
    },
    features: [
      "Flexible 360-degree hinge converts to tablet mode",
      "Spectre rechargeable MPPs 2.0 Tilt Pen included",
      "HP GlamCam with Auto Frame and backlight correction",
      "Crafted from gem-cut dual-tone CNC aluminum"
    ]
  },
  {
    id: 6,
    name: "Lenovo ThinkPad T14 Gen 4",
    category: "laptops-business",
    brand: "lenovo",
    price: 215000,
    oldPrice: 225000,
    rating: 4,
    image: "assets/images/laptops/lenovo-thinkpad.svg",
    badge: "",
    badgeClass: "",
    specs: {
      "Processor": "Intel Core i5-1335U (10 Cores, Up to 4.6 GHz)",
      "RAM": "16GB DDR5 (Upgradable)",
      "Storage": "512GB PCIe 4.0 NVMe SSD",
      "Graphics": "Intel UHD Graphics",
      "Display": "14\" WUXGA (1920 x 1200) IPS Anti-glare 300 nits",
      "OS": "Windows 11 Pro",
      "Warranty": "3 Years Lenovo Warranty"
    },
    features: [
      "Rugged durability tested against 12 military-grade requirements",
      "Excellent keyboard with iconic TrackPoint",
      "Dual array microphones with Dolby Voice",
      "Outstanding battery life with rapid charge support"
    ]
  },
  {
    id: 7,
    name: "ASUS ROG Zephyrus G14 Gaming",
    category: "laptops-gaming",
    brand: "asus",
    price: 425000,
    oldPrice: 449999,
    rating: 5,
    image: "assets/images/laptops/asus-rog.svg",
    badge: "Sale",
    badgeClass: "bg-danger",
    specs: {
      "Processor": "AMD Ryzen 9 7940HS (8 Cores, Up to 5.2 GHz)",
      "RAM": "16GB DDR5 4800MHz (Dual Channel)",
      "Storage": "1TB M.2 NVMe PCIe 4.0 SSD",
      "Graphics": "NVIDIA GeForce RTX 4060 8GB GDDR6",
      "Display": "14\" QHD+ (2560 x 1600) ROG Nebula 165Hz Display",
      "OS": "Windows 11 Home",
      "Warranty": "1 Year International Warranty"
    },
    features: [
      "AniMe Matrix LED lid display for customization",
      "Sleek and compact 1.65kg form factor",
      "Vapor Chamber cooling technology",
      "Dolby Atmos speakers with smart amp tech"
    ]
  },
  {
    id: 8,
    name: "Acer Predator Helios 16 RTX 4080",
    category: "laptops-gaming",
    brand: "acer",
    price: 510000,
    oldPrice: 530000,
    rating: 5,
    image: "assets/images/laptops/acer-predator.svg",
    badge: "Heavy Hitter",
    badgeClass: "bg-dark text-warning border border-warning",
    specs: {
      "Processor": "Intel Core i9-13900HX (24 Cores, Up to 5.4 GHz)",
      "RAM": "32GB DDR5 5600MHz RAM",
      "Storage": "1TB PCIe Gen4 NVMe SSD",
      "Graphics": "NVIDIA GeForce RTX 4080 12GB GDDR6",
      "Display": "16\" WQXGA (2560 x 1600) IPS 240Hz 500 nits",
      "OS": "Windows 11 Home",
      "Warranty": "1 Year Acer Local Warranty"
    },
    features: [
      "5th Gen AeroBlade 3D fan technology",
      "Per-key RGB mechanical backlit keyboard",
      "Ultra-fast Killer DoubleShot Pro Ethernet/Wi-Fi",
      "PredatorSense utility app pre-loaded"
    ]
  },
  {
    id: 9,
    name: "MSI Stealth 16 Studio (Slim)",
    category: "laptops-gaming",
    brand: "msi",
    price: 465000,
    oldPrice: 485000,
    rating: 5,
    image: "assets/images/laptops/msi-stealth.svg",
    badge: "New",
    badgeClass: "bg-success",
    specs: {
      "Processor": "Intel Core i7-13700H (14 Cores, Up to 5.0 GHz)",
      "RAM": "16GB DDR5 5200MHz RAM",
      "Storage": "1TB PCIe Gen4 NVMe M.2 SSD",
      "Graphics": "NVIDIA GeForce RTX 4070 8GB GDDR6",
      "Display": "16\" QHD+ (2560 x 1600) 240Hz IPS-Level Display",
      "OS": "Windows 11 Pro",
      "Warranty": "1 Year MSI Warranty"
    },
    features: [
      "Magnesium-Aluminum alloy chassis (1.99kg)",
      "Dynaudio sound system with 6 speakers",
      "SteelSeries Per-Key RGB keyboard",
      "NVIDIA Studio validated for creators"
    ]
  },
  {
    id: 10,
    name: "Apple MacBook Air 13-inch M3",
    category: "laptops-student",
    brand: "apple",
    price: 329000,
    oldPrice: 345000,
    rating: 5,
    image: "assets/images/laptops/apple-macbook.svg",
    badge: "Best Seller",
    badgeClass: "bg-warning text-dark",
    specs: {
      "Processor": "Apple M3 Chip (8-core CPU, 10-core GPU)",
      "RAM": "8GB Unified Memory",
      "Storage": "256GB Superfast SSD",
      "Graphics": "Apple 10-core Integrated GPU",
      "Display": "13.6\" Liquid Retina Display with True Tone (500 nits)",
      "OS": "macOS Sonoma",
      "Warranty": "1 Year Apple Care Warranty"
    },
    features: [
      "Silent, fanless design for quiet operation",
      "Up to 18 hours of battery life",
      "1080p FaceTime HD camera",
      "MagSafe 3 charging port"
    ]
  },
  {
    id: 11,
    name: "Samsung Odyssey G5 27\" QHD Gaming Monitor",
    category: "monitors",
    brand: "samsung",
    price: 89999,
    oldPrice: 95000,
    rating: 4,
    image: "assets/images/accessories/monitor.svg",
    badge: "Best Seller",
    badgeClass: "bg-warning text-dark",
    specs: {
      "Display Size": "27 Inches",
      "Resolution": "QHD (2560 x 1440)",
      "Refresh Rate": "165Hz",
      "Response Time": "1ms (MPRT)",
      "Panel Type": "VA Curved 1000R",
      "Inputs": "DisplayPort 1.2, HDMI 2.0",
      "Warranty": "1 Year Local Warranty"
    },
    features: [
      "1000R curvature matches contours of the human eye",
      "HDR10 support for spectacular detail",
      "AMD FreeSync Premium compatible",
      "Flicker-Free & Low Blue Light modes"
    ]
  },
  {
    id: 12,
    name: "Redragon K552 Mechanical RGB Keyboard",
    category: "accessories",
    brand: "accessories",
    price: 12499,
    oldPrice: 14999,
    rating: 4.5,
    image: "assets/images/accessories/keyboard.svg",
    badge: "Hot",
    badgeClass: "bg-danger",
    specs: {
      "Switch Type": "Dustproof Blue Switches (Mechanical)",
      "Layout": "Tenkeyless (TKL) 87 Keys",
      "Connectivity": "Wired USB (Gold-plated)",
      "Backlighting": "Chroma RGB LED Backlit (18 modes)",
      "Compatibility": "Windows, Mac, Linux",
      "Warranty": "6 Months Local Warranty"
    },
    features: [
      "Double-shot injection molded keycaps",
      "Metal and ABS construction with plate-mounted keys",
      "100% Anti-Ghosting keys (N-Key Rollover)",
      "Splash-resistant design"
    ]
  },
  {
    id: 13,
    name: "Logitech G502 Hero Wireless Gaming Mouse",
    category: "accessories",
    brand: "accessories",
    price: 7999,
    oldPrice: 9999,
    rating: 4,
    image: "assets/images/accessories/mouse.svg",
    badge: "",
    badgeClass: "",
    specs: {
      "Sensor": "Hero 25K Optical Sensor",
      "DPI Range": "100 - 25,600 DPI",
      "Connectivity": "Wireless Lightspeed + USB Wired",
      "Programmable Buttons": "11 Customizable Buttons",
      "Weight": "114g (Adjustable with weights)",
      "Warranty": "1 Year Brand Warranty"
    },
    features: [
      "Dual-mode hyper-fast scroll wheel",
      "LightSync custom RGB lighting",
      "Mechanical tensioning mouse button design",
      "Mechanical micro-switches rated for 50 million clicks"
    ]
  },
  {
    id: 14,
    name: "Samsung 990 Pro 1TB M.2 PCIe 4.0 NVMe SSD",
    category: "storage",
    brand: "accessories",
    price: 24999,
    oldPrice: 27999,
    rating: 5,
    image: "assets/images/accessories/ssd.svg",
    badge: "Sale",
    badgeClass: "bg-danger",
    specs: {
      "Capacity": "1TB (1000GB)",
      "Form Factor": "M.2 (2280)",
      "Interface": "PCIe Gen 4.0 x4, NVMe 2.0",
      "Sequential Reads": "Up to 7,450 MB/s",
      "Sequential Writes": "Up to 6,900 MB/s",
      "Warranty": "5 Years Limited Warranty"
    },
    features: [
      "Over 55% improvement in random read/write speed over 980 Pro",
      "Smart thermal controller with nickel-coated controller shield",
      "Samsung Magician software support for health checks",
      "Optimal power efficiency with maximum performance"
    ]
  },
  {
    id: 15,
    name: "Logitech StreamCam 1080p Web Camera",
    category: "accessories",
    brand: "accessories",
    price: 28500,
    oldPrice: 32000,
    rating: 4,
    image: "assets/images/accessories/webcam.svg",
    badge: "",
    badgeClass: "",
    specs: {
      "Resolution": "1080p at 60fps / 720p at 60fps",
      "Lens": "Premium Full HD Glass Lens (f/2.0)",
      "Field of View": "78 Degrees",
      "Connection": "USB Type-C 3.1",
      "Audio": "Dual omnidirectional microphones",
      "Warranty": "1 Year Logitech Warranty"
    },
    features: [
      "AI-enabled auto-focus and auto-exposure",
      "Horizontal or vertical full HD video modes",
      "Optimized for Open Broadcaster Software (OBS)",
      "Electronic image stabilization built-in"
    ]
  },
  {
    id: 16,
    name: "Razer BlackShark V2 Pro Gaming Headphones",
    category: "accessories",
    brand: "accessories",
    price: 32999,
    oldPrice: 36999,
    rating: 5,
    image: "assets/images/accessories/headphones.svg",
    badge: "Hot",
    badgeClass: "bg-danger",
    specs: {
      "Drivers": "Razer TriForce Titanium 50mm Drivers",
      "Microphone": "Removable HyperClear Super Cardioid Mic",
      "Connectivity": "Hyperspeed Wireless (2.4GHz) + 3.5mm",
      "Surround Sound": "THX Spatial Audio 7.1",
      "Weight": "320g Ultra-light",
      "Warranty": "1 Year Brand Warranty"
    },
    features: [
      "Advanced passive noise isolation with plush ear cups",
      "Ultra-soft breathable memory foam cushions",
      "THX Game Profiles customized for competitive games",
      "Up to 24 hours of battery life on wireless"
    ]
  },
  {
    id: 17,
    name: "Tigernu Sleek Anti-Theft Laptop Backpack",
    category: "accessories",
    brand: "accessories",
    price: 8500,
    oldPrice: 9999,
    rating: 4.5,
    image: "assets/images/accessories/bag.svg",
    badge: "Sale",
    badgeClass: "bg-danger",
    specs: {
      "Fit Capacity": "Laptops up to 15.6 Inches",
      "Material": "Waterproof & Scratch-resistant Oxford Fabric",
      "Zipper": "Patented double-layer anti-puncture zipper",
      "Dimensions": "43 x 30 x 15 cm",
      "Port": "Built-in USB Charging Port",
      "Warranty": "3 Months Local Warranty"
    },
    features: [
      "Hidden anti-theft back pocket for valuables",
      "Luggage strap on the back for easy travel",
      "Ergonomic S-shaped padded shoulder straps",
      "Multi-compartment layout with organizer organizers"
    ]
  }
];

// --- CART STATE MANAGEMENT ---
const CartManager = {
  getCart() {
    return JSON.parse(localStorage.getItem("te_cart")) || [];
  },
  saveCart(cart) {
    localStorage.setItem("te_cart", JSON.stringify(cart));
    this.updateCounters();
  },
  addToCart(product, qty = 1) {
    let cart = this.getCart();
    let existingItem = cart.find(item => item.id === product.id);
    if (existingItem) {
      existingItem.qty += qty;
    } else {
      cart.push({
        id: product.id,
        name: product.name,
        price: product.price,
        image: product.image,
        category: product.category,
        qty: qty
      });
    }
    this.saveCart(cart);
    this.showAlert(`Added ${product.name} to Cart!`, "success");
  },
  removeFromCart(productId) {
    let cart = this.getCart();
    cart = cart.filter(item => item.id !== productId);
    this.saveCart(cart);
    this.showAlert("Item removed from Cart.", "warning");
  },
  updateQuantity(productId, qty) {
    let cart = this.getCart();
    let item = cart.find(i => i.id === productId);
    if (item) {
      item.qty = parseInt(qty) || 1;
      if (item.qty <= 0) item.qty = 1;
    }
    this.saveCart(cart);
  },
  clearCart() {
    localStorage.removeItem("te_cart");
    this.updateCounters();
  },
  getCartCount() {
    return this.getCart().reduce((sum, item) => sum + item.qty, 0);
  },
  getCartTotal() {
    return this.getCart().reduce((sum, item) => sum + (item.price * item.qty), 0);
  },
  updateCounters() {
    const counters = document.querySelectorAll(".cart-counter");
    const count = this.getCartCount();
    counters.forEach(c => {
      c.textContent = count;
      c.style.display = count > 0 ? "inline-block" : "none";
    });
  },
  showAlert(message, type = "success") {
    // Show a premium overlay toast
    const toast = document.createElement("div");
    toast.className = `alert alert-${type} glass-card position-fixed border border-secondary shadow-lg p-3`;
    toast.style.bottom = "20px";
    toast.style.left = "20px";
    toast.style.zIndex = "9999";
    toast.style.minWidth = "300px";
    toast.style.color = "#ffffff";
    toast.style.background = "rgba(10, 17, 40, 0.95)";
    toast.style.backdropFilter = "blur(10px)";
    toast.style.borderLeft = `5px solid ${type === "success" ? "#00e676" : "#ff9900"} !important`;
    
    toast.innerHTML = `
      <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-${type === 'success' ? 'check-circle-fill text-success' : 'exclamation-triangle-fill text-warning'}" style="font-size: 1.25rem;"></i>
          <span>${message}</span>
        </div>
        <button type="button" class="btn-close btn-close-white ms-2" style="font-size: 0.8rem;" onclick="this.parentElement.parentElement.remove()"></button>
      </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => {
      toast.style.transition = "opacity 0.5s ease";
      toast.style.opacity = "0";
      setTimeout(() => toast.remove(), 500);
    }, 3500);
  }
};

// --- WISHLIST STATE MANAGEMENT ---
const WishlistManager = {
  getWishlist() {
    return JSON.parse(localStorage.getItem("te_wishlist")) || [];
  },
  saveWishlist(list) {
    localStorage.setItem("te_wishlist", JSON.stringify(list));
    this.updateCounters();
  },
  toggleWishlist(product) {
    let list = this.getWishlist();
    let exists = list.some(item => item.id === product.id);
    if (exists) {
      list = list.filter(item => item.id !== product.id);
      this.saveWishlist(list);
      CartManager.showAlert(`Removed ${product.name} from Wishlist.`, "warning");
      return false;
    } else {
      list.push({
        id: product.id,
        name: product.name,
        price: product.price,
        image: product.image,
        category: product.category
      });
      this.saveWishlist(list);
      CartManager.showAlert(`Added ${product.name} to Wishlist!`, "success");
      return true;
    }
  },
  isInWishlist(productId) {
    return this.getWishlist().some(item => item.id === productId);
  },
  getWishlistCount() {
    return this.getWishlist().length;
  },
  updateCounters() {
    const counters = document.querySelectorAll(".wishlist-counter");
    const count = this.getWishlistCount();
    counters.forEach(c => {
      c.textContent = count;
      c.style.display = count > 0 ? "inline-block" : "none";
    });
  }
};

// --- ORDER RECORDS STATE MANAGEMENT ---
const OrderManager = {
  getOrders() {
    return JSON.parse(localStorage.getItem("te_orders")) || [];
  },
  saveOrders(orders) {
    localStorage.setItem("te_orders", JSON.stringify(orders));
  },
  placeOrder(billingInfo, paymentMethod) {
    const cart = CartManager.getCart();
    if (cart.length === 0) return null;
    
    const subtotal = CartManager.getCartTotal();
    const delivery = subtotal > 10000 ? 0 : 250;
    const total = subtotal + delivery;
    
    const orders = this.getOrders();
    const orderNum = "TE-" + Math.floor(100000 + Math.random() * 900000);
    const newOrder = {
      orderNumber: orderNum,
      date: new Date().toLocaleDateString('en-PK', { year: 'numeric', month: 'long', day: 'numeric' }),
      items: cart,
      billing: billingInfo,
      paymentMethod: paymentMethod,
      totalAmount: total,
      paymentStatus: paymentMethod === "cod" ? "Pending" : "Awaiting Verification",
      deliveryStatus: "Processing"
    };
    
    orders.unshift(newOrder); // Add to beginning
    this.saveOrders(orders);
    CartManager.clearCart();
    return orderNum;
  }
};

// --- DOM INITIALIZATION ROUTINE ---
document.addEventListener("DOMContentLoaded", () => {
  // 1. Hide Loader
  const loader = document.getElementById("loader-wrapper");
  if (loader) {
    setTimeout(() => {
      loader.style.opacity = "0";
      loader.style.visibility = "hidden";
    }, 400);
  }

  // 2. Initialize Counters
  CartManager.updateCounters();
  WishlistManager.updateCounters();

  // 3. Sticky Navbar
  const navbar = document.querySelector(".navbar");
  if (navbar) {
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });
  }

  // 4. Back to Top Button
  const bttBtn = document.getElementById("btn-back-to-top");
  if (bttBtn) {
    window.addEventListener("scroll", () => {
      if (window.scrollY > 300) {
        bttBtn.style.display = "flex";
      } else {
        bttBtn.style.display = "none";
      }
    });
    bttBtn.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  }

  // 5. Global Search Handler
  const searchForms = document.querySelectorAll(".global-search-form");
  searchForms.forEach(form => {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const input = form.querySelector("input");
      if (input && input.value.trim() !== "") {
        window.location.href = `products.html?search=${encodeURIComponent(input.value.trim())}`;
      }
    });
  });

  // 6. Execute Page Specific Initializations
  initPageSpecifics();
});

// --- HELPER FUNCTION: FORMAT CURRENCY IN PKR ---
function formatPKR(amount) {
  return "Rs. " + amount.toLocaleString('en-PK');
}

// --- DYNAMIC STAR RENDERER ---
function renderStars(rating) {
  let starsHtml = "";
  const floorRating = Math.floor(rating);
  for (let i = 1; i <= 5; i++) {
    if (i <= floorRating) {
      starsHtml += `<i class="bi bi-star-fill text-warning me-1"></i>`;
    } else if (i - rating === 0.5) {
      starsHtml += `<i class="bi bi-star-half text-warning me-1"></i>`;
    } else {
      starsHtml += `<i class="bi bi-star text-secondary me-1"></i>`;
    }
  }
  return starsHtml;
}

// --- PAGE SPECIFIC INITIALIZERS ---
function initPageSpecifics() {
  const path = window.location.pathname;
  const page = path.substring(path.lastIndexOf('/') + 1);

  // Home Page
  if (page === "index.html" || page === "") {
    initHomePage();
  }
  // Products Page
  else if (page === "products.html") {
    initProductsPage();
  }
  // Product Details Page
  else if (page === "product-details.html") {
    initProductDetailsPage();
  }
  // Cart Page
  else if (page === "cart.html") {
    initCartPage();
  }
  // Wishlist Page
  else if (page === "wishlist.html") {
    initWishlistPage();
  }
  // Checkout Page
  else if (page === "checkout.html") {
    initCheckoutPage();
  }
  // Orders Page
  else if (page === "orders.html") {
    initOrdersPage();
  }
  // Account Page
  else if (page === "my-account.html") {
    initAccountPage();
  }
  // Contact Page
  else if (page === "contact.html") {
    initContactPage();
  }
}

// --- HOME PAGE INITIALIZER ---
function initHomePage() {
  // Load 8 Featured Products dynamically
  const featuredContainer = document.getElementById("featured-products-grid");
  if (featuredContainer) {
    // Select first 8 products from catalog
    const products = PRODUCT_CATALOG.slice(0, 8);
    let html = "";
    products.forEach(p => {
      const activeClass = WishlistManager.isInWishlist(p.id) ? "active" : "";
      const badgeHtml = p.badge ? `<span class="product-badge ${p.badgeClass}">${p.badge}</span>` : "";
      
      html += `
        <div class="col-md-6 col-lg-3 col-sm-6 mb-4">
          <div class="product-card">
            <div class="product-image-wrapper">
              ${badgeHtml}
              <div class="wishlist-btn-pos">
                <button class="btn-wishlist ${activeClass}" data-id="${p.id}"><i class="bi bi-heart-fill"></i></button>
              </div>
              <a href="product-details.html?id=${p.id}" class="hover-zoom w-100 h-100 d-flex align-items-center justify-content-center">
                <img src="${p.image}" alt="${p.name}" class="img-fluid" style="max-height: 180px;">
              </a>
            </div>
            <div class="product-details">
              <a href="product-details.html?id=${p.id}" class="product-title">${p.name}</a>
              <div class="product-rating">
                ${renderStars(p.rating)}
                <span class="text-muted ms-1">(${p.rating})</span>
              </div>
              <div class="product-price">
                <span class="price-current">${formatPKR(p.price)}</span>
                <span class="price-old">${formatPKR(p.oldPrice)}</span>
              </div>
              <button class="btn btn-outline-custom w-100 btn-add-to-cart-action mt-2" data-id="${p.id}">
                <i class="bi bi-cart-plus me-2"></i>Add To Cart
              </button>
            </div>
          </div>
        </div>
      `;
    });
    featuredContainer.innerHTML = html;
  }

  // Load Best Selling Laptops (Brand grid filtration)
  const bestSellingContainer = document.getElementById("best-selling-laptops-grid");
  if (bestSellingContainer) {
    // Select laptop products that are popular
    const laptops = PRODUCT_CATALOG.filter(p => p.category.includes("laptops")).slice(0, 4);
    let html = "";
    laptops.forEach(p => {
      const activeClass = WishlistManager.isInWishlist(p.id) ? "active" : "";
      const badgeHtml = p.badge ? `<span class="product-badge ${p.badgeClass}">${p.badge}</span>` : "";
      
      html += `
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="product-card">
            <div class="product-image-wrapper">
              ${badgeHtml}
              <div class="wishlist-btn-pos">
                <button class="btn-wishlist ${activeClass}" data-id="${p.id}"><i class="bi bi-heart-fill"></i></button>
              </div>
              <a href="product-details.html?id=${p.id}" class="hover-zoom w-100 h-100 d-flex align-items-center justify-content-center">
                <img src="${p.image}" alt="${p.name}" class="img-fluid" style="max-height: 180px;">
              </a>
            </div>
            <div class="product-details">
              <span class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem;">${p.brand}</span>
              <a href="product-details.html?id=${p.id}" class="product-title">${p.name}</a>
              <div class="product-rating">
                ${renderStars(p.rating)}
              </div>
              <div class="product-price">
                <span class="price-current">${formatPKR(p.price)}</span>
                <span class="price-old">${formatPKR(p.oldPrice)}</span>
              </div>
              <button class="btn btn-outline-custom w-100 btn-add-to-cart-action mt-2" data-id="${p.id}">
                <i class="bi bi-cart-plus me-2"></i>Add To Cart
              </button>
            </div>
          </div>
        </div>
      `;
    });
    bestSellingContainer.innerHTML = html;
  }

  // Load Accessories row
  const accessoriesContainer = document.getElementById("accessories-row-grid");
  if (accessoriesContainer) {
    const accs = PRODUCT_CATALOG.filter(p => p.category === "accessories" || p.category === "storage").slice(0, 4);
    let html = "";
    accs.forEach(p => {
      const activeClass = WishlistManager.isInWishlist(p.id) ? "active" : "";
      
      html += `
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="product-card">
            <div class="product-image-wrapper">
              <div class="wishlist-btn-pos">
                <button class="btn-wishlist ${activeClass}" data-id="${p.id}"><i class="bi bi-heart-fill"></i></button>
              </div>
              <a href="product-details.html?id=${p.id}" class="hover-zoom w-100 h-100 d-flex align-items-center justify-content-center">
                <img src="${p.image}" alt="${p.name}" class="img-fluid" style="max-height: 180px;">
              </a>
            </div>
            <div class="product-details">
              <a href="product-details.html?id=${p.id}" class="product-title">${p.name}</a>
              <div class="product-rating">
                ${renderStars(p.rating)}
              </div>
              <div class="product-price">
                <span class="price-current">${formatPKR(p.price)}</span>
                <span class="price-old">${formatPKR(p.oldPrice)}</span>
              </div>
              <button class="btn btn-outline-custom w-100 btn-add-to-cart-action mt-2" data-id="${p.id}">
                <i class="bi bi-cart-plus me-2"></i>Add To Cart
              </button>
            </div>
          </div>
        </div>
      `;
    });
    accessoriesContainer.innerHTML = html;
  }

  attachCardClickHandlers();
}

// --- PRODUCTS CATALOG PAGE INITIALIZER ---
function initProductsPage() {
  const params = new URLSearchParams(window.location.search);
  const searchVal = params.get("search") || "";
  const catVal = params.get("category") || "";
  
  // Set search input UI value
  const searchInput = document.getElementById("catalog-search-input");
  if (searchInput) {
    searchInput.value = searchVal;
  }

  // Pre-select category checkbox
  if (catVal) {
    const chk = document.querySelector(`.category-filter-check[value="${catVal}"]`);
    if (chk) chk.checked = true;
  }

  // Set up price slider sync
  const priceRange = document.getElementById("priceRange");
  const priceValue = document.getElementById("priceRangeValue");
  if (priceRange && priceValue) {
    priceRange.addEventListener("input", (e) => {
      priceValue.textContent = `Rs. ${parseInt(e.target.value).toLocaleString('en-PK')}`;
      renderFilteredCatalog();
    });
  }

  // Set up filter change event listeners
  const filterInputs = document.querySelectorAll(".category-filter-check, .brand-filter-check, #sort-select");
  filterInputs.forEach(input => {
    input.addEventListener("change", renderFilteredCatalog);
  });
  
  if (searchInput) {
    searchInput.addEventListener("input", renderFilteredCatalog);
  }

  // Run initial render
  renderFilteredCatalog();
}

function renderFilteredCatalog() {
  const grid = document.getElementById("catalog-products-grid");
  if (!grid) return;

  const searchInput = document.getElementById("catalog-search-input");
  const searchVal = searchInput ? searchInput.value.toLowerCase().trim() : "";
  
  const priceRange = document.getElementById("priceRange");
  const maxPrice = priceRange ? parseInt(priceRange.value) : 600000;

  // Selected Categories
  const selectedCats = [];
  document.querySelectorAll(".category-filter-check:checked").forEach(chk => {
    selectedCats.push(chk.value);
  });

  // Selected Brands
  const selectedBrands = [];
  document.querySelectorAll(".brand-filter-check:checked").forEach(chk => {
    selectedBrands.push(chk.value);
  });

  // Sort
  const sortSelect = document.getElementById("sort-select");
  const sortVal = sortSelect ? sortSelect.value : "default";

  // Filter Catalog
  let filtered = PRODUCT_CATALOG.filter(p => {
    // Search match
    const matchesSearch = p.name.toLowerCase().includes(searchVal) || 
                          p.category.toLowerCase().includes(searchVal) ||
                          p.brand.toLowerCase().includes(searchVal);
    
    // Price match
    const matchesPrice = p.price <= maxPrice;

    // Category match
    const matchesCategory = selectedCats.length === 0 || selectedCats.some(cat => p.category.includes(cat));

    // Brand match
    const matchesBrand = selectedBrands.length === 0 || selectedBrands.includes(p.brand);

    return matchesSearch && matchesPrice && matchesCategory && matchesBrand;
  });

  // Sort Catalog
  if (sortVal === "price-low") {
    filtered.sort((a, b) => a.price - b.price);
  } else if (sortVal === "price-high") {
    filtered.sort((a, b) => b.price - a.price);
  } else if (sortVal === "rating") {
    filtered.sort((a, b) => b.rating - a.rating);
  }

  // Pagination UI Setup (Static Demo)
  const paginationText = document.getElementById("pagination-results-text");
  if (paginationText) {
    paginationText.textContent = `Showing ${filtered.length} of ${PRODUCT_CATALOG.length} results`;
  }

  // Build Grid HTML
  if (filtered.length === 0) {
    grid.innerHTML = `
      <div class="col-12 text-center py-5">
        <i class="bi bi-search" style="font-size: 3rem; color: var(--text-muted); opacity: 0.5;"></i>
        <h4 class="mt-3">No Products Found</h4>
        <p class="text-muted">Try adjusting your filters or search terms.</p>
        <button class="btn btn-electric mt-2" onclick="resetAllFilters()">Reset Filters</button>
      </div>
    `;
    return;
  }

  let html = "";
  filtered.forEach(p => {
    const activeClass = WishlistManager.isInWishlist(p.id) ? "active" : "";
    const badgeHtml = p.badge ? `<span class="product-badge ${p.badgeClass}">${p.badge}</span>` : "";
    
    html += `
      <div class="col-md-6 col-lg-4 col-sm-6 mb-4">
        <div class="product-card">
          <div class="product-image-wrapper">
            ${badgeHtml}
            <div class="wishlist-btn-pos">
              <button class="btn-wishlist ${activeClass}" data-id="${p.id}"><i class="bi bi-heart-fill"></i></button>
            </div>
            <a href="product-details.html?id=${p.id}" class="hover-zoom w-100 h-100 d-flex align-items-center justify-content-center">
              <img src="${p.image}" alt="${p.name}" class="img-fluid" style="max-height: 180px;">
            </a>
          </div>
          <div class="product-details">
            <span class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem;">${p.brand}</span>
            <a href="product-details.html?id=${p.id}" class="product-title">${p.name}</a>
            <div class="product-rating">
              ${renderStars(p.rating)}
              <span class="text-muted ms-1">(${p.rating})</span>
            </div>
            <div class="product-price">
              <span class="price-current">${formatPKR(p.price)}</span>
              <span class="price-old">${formatPKR(p.oldPrice)}</span>
            </div>
            <button class="btn btn-outline-custom w-100 btn-add-to-cart-action mt-2" data-id="${p.id}">
              <i class="bi bi-cart-plus me-2"></i>Add To Cart
            </button>
          </div>
        </div>
      </div>
    `;
  });
  grid.innerHTML = html;
  attachCardClickHandlers();
}

function resetAllFilters() {
  document.querySelectorAll(".category-filter-check, .brand-filter-check").forEach(chk => chk.checked = false);
  const searchInput = document.getElementById("catalog-search-input");
  if (searchInput) searchInput.value = "";
  
  const priceRange = document.getElementById("priceRange");
  if (priceRange) {
    priceRange.value = 600000;
    const priceValue = document.getElementById("priceRangeValue");
    if (priceValue) priceValue.textContent = `Rs. 600,000`;
  }
  
  const sortSelect = document.getElementById("sort-select");
  if (sortSelect) sortSelect.value = "default";
  
  renderFilteredCatalog();
}

// --- PRODUCT DETAILS PAGE INITIALIZER ---
function initProductDetailsPage() {
  const params = new URLSearchParams(window.location.search);
  const idVal = parseInt(params.get("id")) || 1;
  const product = PRODUCT_CATALOG.find(p => p.id === idVal) || PRODUCT_CATALOG[0];

  // Load Main Product Details
  const titleEl = document.getElementById("detail-product-title");
  const brandEl = document.getElementById("detail-product-brand");
  const priceEl = document.getElementById("detail-product-price");
  const oldPriceEl = document.getElementById("detail-product-old-price");
  const starsEl = document.getElementById("detail-product-stars");
  const ratingTextEl = document.getElementById("detail-product-rating-text");
  const badgeEl = document.getElementById("detail-product-badge");
  const featuresList = document.getElementById("detail-features-list");
  const specsTableBody = document.getElementById("detail-specs-table-body");
  const mainImage = document.getElementById("detail-main-image");
  const galleryThumbs = document.getElementById("detail-gallery-thumbs");
  const descEl = document.getElementById("detail-product-description");

  if (titleEl) titleEl.textContent = product.name;
  if (brandEl) {
    brandEl.textContent = product.brand.toUpperCase();
    brandEl.style.letterSpacing = "1px";
  }
  if (priceEl) priceEl.textContent = formatPKR(product.price);
  if (oldPriceEl) oldPriceEl.textContent = formatPKR(product.oldPrice);
  if (starsEl) starsEl.innerHTML = renderStars(product.rating);
  if (ratingTextEl) ratingTextEl.textContent = `(${product.rating} Customer Rating)`;
  
  if (badgeEl) {
    if (product.badge) {
      badgeEl.textContent = product.badge;
      badgeEl.className = `badge ${product.badgeClass} px-3 py-2`;
      badgeEl.style.display = "inline-block";
    } else {
      badgeEl.style.display = "none";
    }
  }

  // Load image
  if (mainImage) {
    mainImage.src = product.image;
    mainImage.alt = product.name;
  }

  // Load thumbnail gallery (simulated with slight gradient overlay duplicates)
  if (galleryThumbs) {
    galleryThumbs.innerHTML = `
      <div class="thumb-item active"><img src="${product.image}" alt="${product.name}"></div>
      <div class="thumb-item"><img src="${product.image}" style="filter: hue-rotate(45deg);" alt="${product.name}"></div>
      <div class="thumb-item"><img src="${product.image}" style="filter: hue-rotate(90deg);" alt="${product.name}"></div>
      <div class="thumb-item"><img src="${product.image}" style="filter: brightness(1.2);" alt="${product.name}"></div>
    `;

    // Thumb click interactions
    const thumbs = galleryThumbs.querySelectorAll(".thumb-item");
    thumbs.forEach(t => {
      t.addEventListener("click", () => {
        thumbs.forEach(ti => ti.classList.remove("active"));
        t.classList.add("active");
        mainImage.src = t.querySelector("img").src;
        mainImage.style.filter = t.querySelector("img").style.filter;
      });
    });
  }

  // Add Dynamic Description Text
  if (descEl) {
    descEl.textContent = `Experience the next level of technology with the ${product.name}. Engineered to provide peak efficiency, high performance, and unmatched durability for users in Pakistan. Powered by industry-leading components, this device guarantees optimal computing capability whether you are working, gaming, studying, or building creative tasks.`;
  }

  // Load Features
  if (featuresList && product.features) {
    let html = "";
    product.features.forEach(f => {
      html += `<li><i class="bi bi-patch-check text-electric me-2"></i>${f}</li>`;
    });
    featuresList.innerHTML = html;
  }

  // Load Specs Table
  if (specsTableBody && product.specs) {
    let html = "";
    for (const [key, value] of Object.entries(product.specs)) {
      html += `
        <tr>
          <th width="30%">${key}</th>
          <td>${value}</td>
        </tr>
      `;
    }
    specsTableBody.innerHTML = html;
  }

  // Add/Buy Buttons Configuration
  const btnAddToCart = document.getElementById("detail-btn-add-to-cart");
  const btnBuyNow = document.getElementById("detail-btn-buy-now");
  const btnWishlist = document.getElementById("detail-btn-wishlist");
  const qtyInput = document.getElementById("detail-qty-input");

  // Quantity controls
  const btnQtyMinus = document.getElementById("detail-qty-minus");
  const btnQtyPlus = document.getElementById("detail-qty-plus");

  if (btnQtyMinus && qtyInput) {
    btnQtyMinus.addEventListener("click", () => {
      let val = parseInt(qtyInput.value) || 1;
      if (val > 1) qtyInput.value = val - 1;
    });
  }
  if (btnQtyPlus && qtyInput) {
    btnQtyPlus.addEventListener("click", () => {
      let val = parseInt(qtyInput.value) || 1;
      qtyInput.value = val + 1;
    });
  }

  if (btnAddToCart) {
    btnAddToCart.addEventListener("click", () => {
      const qty = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
      CartManager.addToCart(product, qty);
    });
  }

  if (btnBuyNow) {
    btnBuyNow.addEventListener("click", () => {
      const qty = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
      CartManager.addToCart(product, qty);
      window.location.href = "checkout.html";
    });
  }

  if (btnWishlist) {
    let inWishlist = WishlistManager.isInWishlist(product.id);
    updateDetailsWishlistBtn(btnWishlist, inWishlist);
    
    btnWishlist.addEventListener("click", () => {
      const added = WishlistManager.toggleWishlist(product);
      updateDetailsWishlistBtn(btnWishlist, added);
    });
  }

  // Render Related Products
  const relatedGrid = document.getElementById("related-products-grid");
  if (relatedGrid) {
    // Pull products of similar category
    const related = PRODUCT_CATALOG.filter(p => p.category === product.category && p.id !== product.id).slice(0, 4);
    // If fewer than 4, pull other laptops/accessories
    if (related.length < 4) {
      const extra = PRODUCT_CATALOG.filter(p => p.id !== product.id && !related.some(r => r.id === p.id)).slice(0, 4 - related.length);
      related.push(...extra);
    }

    let html = "";
    related.forEach(p => {
      const activeClass = WishlistManager.isInWishlist(p.id) ? "active" : "";
      
      html += `
        <div class="col-md-6 col-lg-3 col-sm-6 mb-4">
          <div class="product-card">
            <div class="product-image-wrapper">
              <div class="wishlist-btn-pos">
                <button class="btn-wishlist ${activeClass}" data-id="${p.id}"><i class="bi bi-heart-fill"></i></button>
              </div>
              <a href="product-details.html?id=${p.id}" class="hover-zoom w-100 h-100 d-flex align-items-center justify-content-center">
                <img src="${p.image}" alt="${p.name}" class="img-fluid" style="max-height: 150px;">
              </a>
            </div>
            <div class="product-details">
              <a href="product-details.html?id=${p.id}" class="product-title" style="font-size:0.9rem;">${p.name}</a>
              <div class="product-rating">
                ${renderStars(p.rating)}
              </div>
              <div class="product-price">
                <span class="price-current" style="font-size:1rem;">${formatPKR(p.price)}</span>
              </div>
              <button class="btn btn-outline-custom w-100 btn-add-to-cart-action mt-2 btn-sm" data-id="${p.id}">
                <i class="bi bi-cart-plus me-1"></i>Add To Cart
              </button>
            </div>
          </div>
        </div>
      `;
    });
    relatedGrid.innerHTML = html;
    attachCardClickHandlers();
  }
}

function updateDetailsWishlistBtn(btn, active) {
  if (active) {
    btn.innerHTML = `<i class="bi bi-heart-fill me-2 text-danger"></i>Wishlisted`;
    btn.classList.add("btn-danger");
    btn.classList.remove("btn-outline-custom");
    btn.style.color = "#ffffff";
    btn.style.borderColor = "#ff3366";
    btn.style.background = "#ff3366";
  } else {
    btn.innerHTML = `<i class="bi bi-heart me-2"></i>Add to Wishlist`;
    btn.classList.remove("btn-danger");
    btn.classList.add("btn-outline-custom");
    btn.style.background = "transparent";
    btn.style.color = "#ffffff";
    btn.style.borderColor = "var(--electric-blue)";
  }
}

// --- CART PAGE INITIALIZER ---
function initCartPage() {
  renderCart();
}

function renderCart() {
  const tableBody = document.getElementById("cart-table-body");
  const cartSummary = document.getElementById("cart-summary-card");
  const cartContent = document.getElementById("cart-content-wrapper");
  const emptyCart = document.getElementById("empty-cart-message");
  
  const cart = CartManager.getCart();
  
  if (cart.length === 0) {
    if (cartContent) cartContent.style.setProperty("display", "none", "important");
    if (emptyCart) emptyCart.style.setProperty("display", "block", "important");
    return;
  }
  
  if (cartContent) cartContent.style.setProperty("display", "flex", "important");
  if (emptyCart) emptyCart.style.setProperty("display", "none", "important");

  if (tableBody) {
    let html = "";
    cart.forEach(item => {
      const subtotal = item.price * item.qty;
      html += `
        <tr data-id="${item.id}">
          <td class="align-middle">
            <div class="d-flex align-items-center gap-3">
              <img src="${item.image}" alt="${item.name}" class="cart-item-img">
              <div>
                <a href="product-details.html?id=${item.id}" class="text-white fw-bold d-block text-truncate" style="max-width:250px;">${item.name}</a>
                <span class="text-muted text-uppercase" style="font-size:0.75rem;">${item.category}</span>
              </div>
            </div>
          </td>
          <td class="align-middle text-orange fw-bold">${formatPKR(item.price)}</td>
          <td class="align-middle">
            <div class="quantity-control">
              <button class="btn-cart-qty-minus" data-id="${item.id}">-</button>
              <input type="number" value="${item.qty}" min="1" readonly class="cart-qty-input" data-id="${item.id}">
              <button class="btn-cart-qty-plus" data-id="${item.id}">+</button>
            </div>
          </td>
          <td class="align-middle text-white fw-bold">${formatPKR(subtotal)}</td>
          <td class="align-middle text-center">
            <button class="btn btn-sm btn-outline-danger btn-cart-remove" data-id="${item.id}">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      `;
    });
    tableBody.innerHTML = html;

    // Attach listeners for cart actions
    tableBody.querySelectorAll(".btn-cart-qty-minus").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = parseInt(btn.dataset.id);
        const input = tableBody.querySelector(`.cart-qty-input[data-id="${id}"]`);
        let val = parseInt(input.value) || 1;
        if (val > 1) {
          input.value = val - 1;
          CartManager.updateQuantity(id, val - 1);
          renderCart();
        }
      });
    });

    tableBody.querySelectorAll(".btn-cart-qty-plus").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = parseInt(btn.dataset.id);
        const input = tableBody.querySelector(`.cart-qty-input[data-id="${id}"]`);
        let val = parseInt(input.value) || 1;
        input.value = val + 1;
        CartManager.updateQuantity(id, val + 1);
        renderCart();
      });
    });

    tableBody.querySelectorAll(".btn-cart-remove").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = parseInt(btn.dataset.id);
        CartManager.removeFromCart(id);
        renderCart();
      });
    });
  }

  // Render totals
  const subtotal = CartManager.getCartTotal();
  const delivery = subtotal > 10000 ? 0 : 250;
  const total = subtotal + delivery;

  const subtotalEl = document.getElementById("cart-subtotal");
  const deliveryEl = document.getElementById("cart-delivery");
  const totalEl = document.getElementById("cart-total");

  if (subtotalEl) subtotalEl.textContent = formatPKR(subtotal);
  if (deliveryEl) deliveryEl.textContent = delivery === 0 ? "Free Shipping" : formatPKR(delivery);
  if (totalEl) totalEl.textContent = formatPKR(total);
}

// --- WISHLIST PAGE INITIALIZER ---
function initWishlistPage() {
  renderWishlist();
}

function renderWishlist() {
  const grid = document.getElementById("wishlist-products-grid");
  const emptyMsg = document.getElementById("empty-wishlist-message");
  const list = WishlistManager.getWishlist();

  if (!grid) return;

  if (list.length === 0) {
    grid.style.setProperty("display", "none", "important");
    if (emptyMsg) emptyMsg.style.setProperty("display", "block", "important");
    return;
  }

  grid.style.setProperty("display", "flex", "important");
  if (emptyMsg) emptyMsg.style.setProperty("display", "none", "important");

  let html = "";
  list.forEach(p => {
    html += `
      <div class="col-md-6 col-lg-3 col-sm-6 mb-4">
        <div class="product-card">
          <div class="product-image-wrapper">
            <div class="wishlist-btn-pos">
              <button class="btn btn-sm btn-danger rounded-circle btn-wishlist-remove" data-id="${p.id}" style="width:36px;height:36px;"><i class="bi bi-trash"></i></button>
            </div>
            <a href="product-details.html?id=${p.id}" class="hover-zoom w-100 h-100 d-flex align-items-center justify-content-center">
              <img src="${p.image}" alt="${p.name}" class="img-fluid" style="max-height: 180px;">
            </a>
          </div>
          <div class="product-details">
            <a href="product-details.html?id=${p.id}" class="product-title">${p.name}</a>
            <div class="product-price mt-2">
              <span class="price-current">${formatPKR(p.price)}</span>
            </div>
            <div class="d-flex gap-2 mt-2">
              <button class="btn btn-electric w-100 btn-wishlist-to-cart" data-id="${p.id}">
                <i class="bi bi-cart-plus me-1"></i>Move To Cart
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
  });
  grid.innerHTML = html;

  // Add click events
  grid.querySelectorAll(".btn-wishlist-remove").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = parseInt(btn.dataset.id);
      const product = PRODUCT_CATALOG.find(p => p.id === id);
      if (product) {
        WishlistManager.toggleWishlist(product);
        renderWishlist();
      }
    });
  });

  grid.querySelectorAll(".btn-wishlist-to-cart").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = parseInt(btn.dataset.id);
      const product = PRODUCT_CATALOG.find(p => p.id === id);
      if (product) {
        CartManager.addToCart(product, 1);
        WishlistManager.toggleWishlist(product); // Remove from wishlist
        renderWishlist();
      }
    });
  });
}

// --- CHECKOUT PAGE INITIALIZER ---
function initCheckoutPage() {
  const cart = CartManager.getCart();
  const checkoutForm = document.getElementById("checkout-form");
  const summaryList = document.getElementById("checkout-summary-list");
  const checkoutSubtotal = document.getElementById("checkout-subtotal");
  const checkoutDelivery = document.getElementById("checkout-delivery");
  const checkoutTotal = document.getElementById("checkout-total");
  const sameAsBilling = document.getElementById("same-as-billing");
  
  if (cart.length === 0) {
    CartManager.showAlert("Your cart is empty. Redirecting to products catalog...", "warning");
    setTimeout(() => {
      window.location.href = "products.html";
    }, 1500);
    return;
  }

  // Render Order Summary
  if (summaryList) {
    let html = "";
    cart.forEach(item => {
      html += `
        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom border-secondary pb-2">
          <div>
            <h6 class="mb-0 text-white text-truncate" style="max-width:180px;">${item.name}</h6>
            <small class="text-muted">Qty: ${item.qty} &times; ${formatPKR(item.price)}</small>
          </div>
          <span class="text-white fw-bold">${formatPKR(item.price * item.qty)}</span>
        </div>
      `;
    });
    summaryList.innerHTML = html;
  }

  const subtotal = CartManager.getCartTotal();
  const delivery = subtotal > 10000 ? 0 : 250;
  const total = subtotal + delivery;

  if (checkoutSubtotal) checkoutSubtotal.textContent = formatPKR(subtotal);
  if (checkoutDelivery) checkoutDelivery.textContent = delivery === 0 ? "Free Shipping" : formatPKR(delivery);
  if (checkoutTotal) checkoutTotal.textContent = formatPKR(total);

  // Address check box sync
  if (sameAsBilling) {
    sameAsBilling.addEventListener("change", (e) => {
      const shippingFields = document.getElementById("shipping-fields-wrapper");
      if (shippingFields) {
        shippingFields.style.display = e.target.checked ? "none" : "block";
      }
    });
  }

  // Place Order Action
  if (checkoutForm) {
    checkoutForm.addEventListener("submit", (e) => {
      e.preventDefault();
      
      const billing = {
        fullName: document.getElementById("billing-name").value,
        email: document.getElementById("billing-email").value,
        phone: document.getElementById("billing-phone").value,
        city: document.getElementById("billing-city").value,
        address: document.getElementById("billing-address").value
      };
      
      const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
      
      const orderNum = OrderManager.placeOrder(billing, paymentMethod);
      if (orderNum) {
        CartManager.showAlert("Order Placed Successfully! Redirecting...", "success");
        setTimeout(() => {
          window.location.href = `orders.html?order=${orderNum}`;
        }, 2000);
      }
    });
  }
}

// --- ORDERS PAGE INITIALIZER ---
function initOrdersPage() {
  const orders = OrderManager.getOrders();
  const ordersContainer = document.getElementById("orders-history-list");
  const params = new URLSearchParams(window.location.search);
  const successOrderNum = params.get("order");

  if (successOrderNum) {
    const banner = document.getElementById("order-success-banner");
    if (banner) {
      banner.style.display = "block";
      const successNumEl = document.getElementById("success-order-number");
      if (successNumEl) successNumEl.textContent = successOrderNum;
    }
  }

  if (ordersContainer) {
    if (orders.length === 0) {
      ordersContainer.innerHTML = `
        <div class="text-center py-5 border border-secondary rounded glass-card">
          <i class="bi bi-receipt-cutoff" style="font-size: 3rem; color: var(--text-muted); opacity: 0.5;"></i>
          <h5 class="mt-3 text-white">No Orders Placed Yet</h5>
          <p class="text-muted">Your order history will appear here once you place orders.</p>
          <a href="products.html" class="btn btn-electric mt-2">Explore Shop</a>
        </div>
      `;
      return;
    }

    let html = "";
    orders.forEach((order, idx) => {
      let itemsHtml = "";
      order.items.forEach(it => {
        itemsHtml += `
          <div class="d-flex align-items-center gap-2 mb-2">
            <img src="${it.image}" alt="${it.name}" style="width:40px;height:30px;object-fit:cover;border-radius:4px;">
            <small class="text-white text-truncate" style="max-width:300px;">${it.name} (Qty: ${it.qty})</small>
          </div>
        `;
      });

      const paymentBadgeClass = order.paymentStatus === "Pending" ? "bg-warning text-dark" : "bg-success";
      const deliveryBadgeClass = order.deliveryStatus === "Processing" ? "bg-info text-dark" : "bg-success";

      html += `
        <div class="card glass-card mb-4 border border-secondary">
          <div class="card-header bg-dark border-bottom border-secondary d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
              <span class="text-muted me-2">Order:</span>
              <strong class="text-electric">${order.orderNumber}</strong>
            </div>
            <div>
              <span class="text-muted me-2">Date:</span>
              <span class="text-white">${order.date}</span>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-3 mb-md-0">
                <h6 class="text-white border-bottom border-secondary pb-1">Items Ordered</h6>
                ${itemsHtml}
              </div>
              <div class="col-md-3 mb-3 mb-md-0">
                <h6 class="text-white border-bottom border-secondary pb-1">Shipment Information</h6>
                <p class="mb-1 text-white small"><strong>Name:</strong> ${order.billing.fullName}</p>
                <p class="mb-1 text-white small"><strong>City:</strong> ${order.billing.city}</p>
                <p class="mb-1 text-white small"><strong>Address:</strong> ${order.billing.address}</p>
              </div>
              <div class="col-md-3">
                <h6 class="text-white border-bottom border-secondary pb-1">Summary</h6>
                <p class="mb-1 text-white small"><strong>Total:</strong> <span class="text-orange fw-bold">${formatPKR(order.totalAmount)}</span></p>
                <p class="mb-1 text-white small"><strong>Payment Method:</strong> ${order.paymentMethod.toUpperCase()}</p>
                <p class="mb-1 small">
                  <strong>Payment Status:</strong> 
                  <span class="badge ${paymentBadgeClass}">${order.paymentStatus}</span>
                </p>
                <p class="mb-0 small">
                  <strong>Delivery Status:</strong> 
                  <span class="badge ${deliveryBadgeClass}">${order.deliveryStatus}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      `;
    });
    ordersContainer.innerHTML = html;
  }
}

// --- ACCOUNT PAGE INITIALIZER ---
function initAccountPage() {
  const profileForm = document.getElementById("profile-settings-form");
  const savedAddressForm = document.getElementById("address-settings-form");
  const clearHistoryBtn = document.getElementById("btn-clear-order-history");

  // Load static or saved profile details
  const localProfile = JSON.parse(localStorage.getItem("te_profile")) || {
    name: "Muhammad Ali",
    email: "ali.tech@gmail.com",
    phone: "0300-1234567",
    city: "Lahore",
    address: "House 45A, Block C, DHA Phase 5"
  };

  const nameInput = document.getElementById("profile-name");
  const emailInput = document.getElementById("profile-email");
  const phoneInput = document.getElementById("profile-phone");
  const addressNameInput = document.getElementById("address-name");
  const addressCityInput = document.getElementById("address-city");
  const addressValInput = document.getElementById("address-value");

  if (nameInput) nameInput.value = localProfile.name;
  if (emailInput) emailInput.value = localProfile.email;
  if (phoneInput) phoneInput.value = localProfile.phone;
  if (addressNameInput) addressNameInput.value = localProfile.name;
  if (addressCityInput) addressCityInput.value = localProfile.city;
  if (addressValInput) addressValInput.value = localProfile.address;

  // Profile Save
  if (profileForm) {
    profileForm.addEventListener("submit", (e) => {
      e.preventDefault();
      localProfile.name = nameInput.value;
      localProfile.email = emailInput.value;
      localProfile.phone = phoneInput.value;
      localStorage.setItem("te_profile", JSON.stringify(localProfile));
      CartManager.showAlert("Profile Settings Saved!", "success");
    });
  }

  // Address Save
  if (savedAddressForm) {
    savedAddressForm.addEventListener("submit", (e) => {
      e.preventDefault();
      localProfile.city = addressCityInput.value;
      localProfile.address = addressValInput.value;
      localStorage.setItem("te_profile", JSON.stringify(localProfile));
      CartManager.showAlert("Billing Address Updated!", "success");
    });
  }

  // Clear orders history
  if (clearHistoryBtn) {
    clearHistoryBtn.addEventListener("click", () => {
      if (confirm("Are you sure you want to clear your local order history? This cannot be undone.")) {
        localStorage.removeItem("te_orders");
        CartManager.showAlert("Order history cleared.", "warning");
        setTimeout(() => window.location.reload(), 1000);
      }
    });
  }

  // Update dynamic counters and details in dashboard tabs
  const dashboardCartCount = document.getElementById("dashboard-cart-count");
  const dashboardWishCount = document.getElementById("dashboard-wishlist-count");
  const dashboardOrderCount = document.getElementById("dashboard-orders-count");

  if (dashboardCartCount) dashboardCartCount.textContent = CartManager.getCartCount();
  if (dashboardWishCount) dashboardWishCount.textContent = WishlistManager.getWishlistCount();
  if (dashboardOrderCount) dashboardOrderCount.textContent = OrderManager.getOrders().length;
}

// --- CONTACT PAGE INITIALIZER ---
function initContactPage() {
  const contactForm = document.getElementById("contact-inquiry-form");
  if (contactForm) {
    contactForm.addEventListener("submit", (e) => {
      e.preventDefault();
      CartManager.showAlert("Message Sent! Our representative will contact you shortly.", "success");
      contactForm.reset();
    });
  }
}

// --- GLOBAL ATTACHMENT FOR PRODUCT CARD TRIGGERS ---
function attachCardClickHandlers() {
  // Add to cart buttons
  document.querySelectorAll(".btn-add-to-cart-action").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      const id = parseInt(btn.dataset.id);
      const product = PRODUCT_CATALOG.find(p => p.id === id);
      if (product) {
        CartManager.addToCart(product, 1);
      }
    });
  });

  // Wishlist toggle buttons
  document.querySelectorAll(".btn-wishlist").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      const id = parseInt(btn.dataset.id);
      const product = PRODUCT_CATALOG.find(p => p.id === id);
      if (product) {
        const added = WishlistManager.toggleWishlist(product);
        if (added) {
          btn.classList.add("active");
        } else {
          btn.classList.remove("active");
        }
      }
    });
  });
}
