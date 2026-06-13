/* ==========================================================================
   Tech Emporium Admin Dashboard scripts
   ========================================================================== */

// --- INITIALIZE LOCAL STORAGE DB ---
const DEFAULT_PRODUCTS = [
  { id: 1, name: "ASUS ROG Strix G16 (2024)", sku: "LP-AS-ST-01", category: "Gaming Laptops", brand: "Asus", price: 389999, salePrice: 379999, stock: 12, status: "Active", rating: 5, image: "gaming-laptop.svg", desc: "High FPS gaming setups with RTX graphics and liquid metal cooling.", specs: "Processor: Core i9 13980HX\nRAM: 16GB DDR5\nStorage: 1TB NVMe SSD\nGraphics: RTX 4070 8GB" },
  { id: 2, name: "Lenovo ThinkPad X1 Carbon Gen 11", sku: "LP-LE-TP-02", category: "Business Laptops", brand: "Lenovo", price: 425000, salePrice: 410000, stock: 5, status: "Active", rating: 5, image: "business-laptop.svg", desc: "Thin, light & military grade secure notebooks.", specs: "Processor: Core i7 1365U\nRAM: 32GB LPDDR5\nStorage: 1TB NVMe SSD\nGraphics: Intel Iris Xe" },
  { id: 3, name: "HP Pavilion Plus 14 (Ryzen 7)", sku: "LP-HP-PV-03", category: "Student Laptops", brand: "HP", price: 189999, salePrice: 184999, stock: 25, status: "Active", rating: 4, image: "student-laptop.svg", desc: "Affordable, reliable everyday laptops with brilliant OLED screen.", specs: "Processor: AMD Ryzen 7 7840U\nRAM: 16GB LPDDR5x\nStorage: 512GB NVMe SSD\nGraphics: Radeon 780M" },
  { id: 4, name: "Dell XPS 15 9530 Core i7", sku: "LP-DE-XP-04", category: "Business Laptops", brand: "Dell", price: 385000, salePrice: 379000, stock: 2, status: "Active", rating: 5, image: "dell-xps.svg", desc: "Premium designer laptop with infinity edge display.", specs: "Processor: Core i7 13700H\nRAM: 16GB DDR5\nStorage: 1TB NVMe SSD\nGraphics: RTX 4050 6GB" },
  { id: 5, name: "HP Spectre x360 14 2-in-1", sku: "LP-HP-SP-05", category: "Student Laptops", brand: "HP", price: 345000, salePrice: 339000, stock: 0, status: "Inactive", rating: 5, image: "hp-spectre.svg", desc: "Flexible 360-degree convertible laptop with stylus support.", specs: "Processor: Core i7 1355U\nRAM: 16GB LPDDR5\nStorage: 1TB NVMe SSD\nGraphics: Intel Iris Xe" },
  { id: 6, name: "Apple MacBook Air 13-inch M3", sku: "LP-AP-MA-06", category: "Student Laptops", brand: "Apple", price: 329000, salePrice: 319000, stock: 18, status: "Active", rating: 5, image: "apple-macbook.svg", desc: "Silent, fanless design with up to 18 hours of battery life.", specs: "Processor: Apple M3 Chip\nRAM: 8GB Unified\nStorage: 256GB SSD\nGraphics: 10-core GPU" },
  { id: 7, name: "Samsung Odyssey G5 27\" Curved", sku: "MN-SA-OD-07", category: "Monitors", brand: "Samsung", price: 89999, salePrice: 84999, stock: 8, status: "Active", rating: 4, image: "monitor.svg", desc: "QHD Curved gaming monitor with 165Hz refresh rate.", specs: "Size: 27 Inches\nResolution: 2560x1440\nRefresh: 165Hz\nPanel: VA Curved 1000R" },
  { id: 8, name: "Redragon K552 RGB Keyboard", sku: "AC-RE-KB-08", category: "Accessories", brand: "Accessories", price: 12499, salePrice: 11499, stock: 4, status: "Active", rating: 4.5, image: "keyboard.svg", desc: "Mechanical keyboard with dustproof mechanical switches.", specs: "Switch: Dustproof Blue\nLayout: TKL 87 keys\nLED: RGB customizable" },
  { id: 9, name: "Samsung 990 Pro 1TB SSD", sku: "ST-SA-NV-09", category: "Storage Devices", brand: "Samsung", price: 24999, salePrice: 23999, stock: 45, status: "Active", rating: 5, image: "ssd.svg", desc: "Ultra-fast NVMe PCIe 4.0 storage drive.", specs: "Interface: PCIe 4.0 x4\nRead Speed: 7450 MB/s\nWrite Speed: 6900 MB/s" }
];

const DEFAULT_CATEGORIES = [
  { id: 1, name: "Gaming Laptops", image: "gaming-laptop.svg", count: 2, status: "Active" },
  { id: 2, name: "Business Laptops", image: "business-laptop.svg", count: 2, status: "Active" },
  { id: 3, name: "Student Laptops", image: "student-laptop.svg", count: 3, status: "Active" },
  { id: 4, name: "Accessories", image: "keyboard.svg", count: 1, status: "Active" },
  { id: 5, name: "Monitors", image: "monitor.svg", count: 1, status: "Active" },
  { id: 6, name: "Storage Devices", image: "ssd.svg", count: 1, status: "Active" }
];

const DEFAULT_BRANDS = [
  { id: 1, logo: "dell.svg", name: "Dell", status: "Active", productCount: 1 },
  { id: 2, logo: "hp.svg", name: "HP", status: "Active", productCount: 2 },
  { id: 3, logo: "lenovo.svg", name: "Lenovo", status: "Active", productCount: 1 },
  { id: 4, logo: "asus.svg", name: "Asus", status: "Active", productCount: 1 },
  { id: 5, logo: "acer.svg", name: "Acer", status: "Active", productCount: 0 },
  { id: 6, logo: "msi.svg", name: "MSI", status: "Active", productCount: 0 },
  { id: 7, logo: "apple.svg", name: "Apple", status: "Active", productCount: 1 }
];

const DEFAULT_ORDERS = [
  { orderNumber: "TE-582914", customerName: "Muhammad Ali", customerEmail: "ali.m@gmail.com", customerPhone: "+92 300 1234567", customerAddress: "DHA Phase 6, Karachi", date: "2026-06-08", paymentMethod: "Easypaisa", amount: 389999, paymentStatus: "Completed", deliveryStatus: "Delivered", items: [{ name: "ASUS ROG Strix G16 (2024)", qty: 1, price: 389999 }] },
  { orderNumber: "TE-184920", customerName: "Ayesha Khan", customerEmail: "ayesha.k@yahoo.com", customerPhone: "+92 321 9876543", customerAddress: "Gulberg III, Lahore", date: "2026-06-07", paymentMethod: "Bank Transfer", amount: 425000, paymentStatus: "Completed", deliveryStatus: "Shipped", items: [{ name: "Lenovo ThinkPad X1 Carbon Gen 11", qty: 1, price: 425000 }] },
  { orderNumber: "TE-940284", customerName: "Zainab Malik", customerEmail: "zmalik@outlook.com", customerPhone: "+92 333 4567890", customerAddress: "F-10/2, Islamabad", date: "2026-06-06", paymentMethod: "Cash On Delivery", amount: 202498, paymentStatus: "Pending", deliveryStatus: "Processing", items: [{ name: "HP Pavilion Plus 14 (Ryzen 7)", qty: 1, price: 189999 }, { name: "Redragon K552 RGB Keyboard", qty: 1, price: 12499 }] },
  { orderNumber: "TE-402941", customerName: "Usman Ahmed", customerEmail: "usman.ahmed@gmail.com", customerPhone: "+92 345 5432109", customerAddress: "Satellite Town, Rawalpindi", date: "2026-06-05", paymentMethod: "JazzCash", amount: 89999, paymentStatus: "Completed", deliveryStatus: "Delivered", items: [{ name: "Samsung Odyssey G5 27\" Curved", qty: 1, price: 89999 }] },
  { orderNumber: "TE-602948", customerName: "Hamza Siddiqui", customerEmail: "hamza.sid@gmail.com", customerPhone: "+92 312 8765432", customerAddress: "Gulshan-e-Iqbal, Karachi", date: "2026-06-04", paymentMethod: "Cash On Delivery", amount: 24999, paymentStatus: "Pending", deliveryStatus: "Pending", items: [{ name: "Samsung 990 Pro 1TB SSD", qty: 1, price: 24999 }] },
  { orderNumber: "TE-302947", customerName: "Sana Tariq", customerEmail: "sana.t@gmail.com", customerPhone: "+92 301 7654321", customerAddress: "Samanabad, Lahore", date: "2026-06-02", paymentMethod: "Easypaisa", amount: 329000, paymentStatus: "Refunded", deliveryStatus: "Cancelled", items: [{ name: "Apple MacBook Air 13-inch M3", qty: 1, price: 329000 }] }
];

const DEFAULT_CUSTOMERS = [
  { id: 1, name: "Muhammad Ali", email: "ali.m@gmail.com", phone: "+92 300 1234567", orderCount: 4, spending: 650000, image: "user1.jpg", address: "DHA Phase 6, Karachi", wishlist: ["Samsung 990 Pro 1TB SSD"] },
  { id: 2, name: "Ayesha Khan", email: "ayesha.k@yahoo.com", phone: "+92 321 9876543", orderCount: 2, spending: 512000, image: "user2.jpg", address: "Gulberg III, Lahore", wishlist: [] },
  { id: 3, name: "Zainab Malik", email: "zmalik@outlook.com", phone: "+92 333 4567890", orderCount: 1, spending: 202498, image: "user3.jpg", address: "F-10/2, Islamabad", wishlist: ["HP Spectre x360 14"] },
  { id: 4, name: "Usman Ahmed", email: "usman.ahmed@gmail.com", phone: "+92 345 5432109", orderCount: 3, spending: 180000, image: "user4.jpg", address: "Satellite Town, Rawalpindi", wishlist: [] },
  { id: 5, name: "Hamza Siddiqui", email: "hamza.sid@gmail.com", phone: "+92 312 8765432", orderCount: 1, spending: 24999, image: "user5.jpg", address: "Gulshan-e-Iqbal, Karachi", wishlist: ["ASUS ROG Strix G16"] }
];

const DEFAULT_SELLERS = [
  { id: 1, name: "TechZone Pakistan", email: "info@techzone.pk", rating: 4.8, productsCount: 150, joinedDate: "2024-01-15", status: "Active", revenue: 1450000 },
  { id: 2, name: "Computer City Store", email: "sales@computercity.com.pk", rating: 4.5, productsCount: 85, joinedDate: "2024-06-20", status: "Active", revenue: 820000 },
  { id: 3, name: "Laptop Hub", email: "support@laptophub.pk", rating: 4.9, productsCount: 40, joinedDate: "2025-02-10", status: "Active", revenue: 2300000 },
  { id: 4, name: "Gaming Gear Co.", email: "gg@gaminggear.pk", rating: 4.2, productsCount: 110, joinedDate: "2025-05-01", status: "Active", revenue: 320000 }
];

const DEFAULT_REVIEWS = [
  { id: 1, customer: "Muhammad Ali", product: "ASUS ROG Strix G16 (2024)", rating: 5, reviewText: "Monster machine! The liquid metal cooling keeps temperatures stable. Delivery to Karachi was fast.", date: "2026-06-08", status: "Approved" },
  { id: 2, customer: "Ayesha Khan", product: "Lenovo ThinkPad X1 Carbon Gen 11", rating: 5, reviewText: "Extremely lightweight and professional. Keyboard tactile feel is premium. Ideal for developer workloads.", date: "2026-06-07", status: "Approved" },
  { id: 3, customer: "Hamza Siddiqui", product: "Samsung 990 Pro 1TB SSD", rating: 4.5, reviewText: "Superb speeds. Cut down boot time of my Windows and game loading speed down to seconds.", date: "2026-06-05", status: "Pending" },
  { id: 4, customer: "Usman Ahmed", product: "Samsung Odyssey G5 27\" Curved", rating: 3, reviewText: "The display panel is great but the stand takes up too much desk space. Color calibration out of box was slightly cool.", date: "2026-06-04", status: "Approved" },
  { id: 5, customer: "Bilal Yusuf", product: "Redragon K552 RGB Keyboard", rating: 5, reviewText: "Loud clicky keys, fantastic build quality for the price tag. Highly recommended entry-level mechanical keyboard.", date: "2026-06-02", status: "Pending" }
];

const DEFAULT_COUPONS = [
  { code: "TECH10", type: "Percentage", value: 10, expiryDate: "2026-08-31", status: "Active" },
  { code: "COD2000", type: "Fixed PKR", value: 2000, expiryDate: "2026-07-15", status: "Active" },
  { code: "STUDENT5", type: "Percentage", value: 5, expiryDate: "2026-12-31", status: "Active" },
  { code: "EXPIRED50", type: "Percentage", value: 50, expiryDate: "2026-05-01", status: "Expired" }
];

const DEFAULT_BANNERS = [
  { title: "Pakistan's Ultimate Hardware Hub", subtitle: "Latest Laptops & Accessories in Pakistan", buttonText: "Shop Now", image: "hero.svg", status: "Active" },
  { title: "High FPS RTX Gaming Gear", subtitle: "Equip your battlestation with premium graphics", buttonText: "Explore Collection", image: "gaming-laptop.svg", status: "Active" },
  { title: "Military Grade Secure Notebooks", subtitle: "Thin & light executive laptops with premier warranty", buttonText: "Explore Business", image: "business-laptop.svg", status: "Inactive" }
];

const DEFAULT_SETTINGS = {
  storeName: "Tech Emporium",
  storeEmail: "sales@techemporium.com.pk",
  phone: "+92 (21) 111-832-436",
  address: "Plot 56B, Sector 23, Korangi Industrial Area, Karachi, Pakistan",
  easypaisaActive: true,
  jazzcashActive: true,
  bankActive: true,
  codActive: true,
  shippingCharges: 250,
  freeShippingLimit: 10000,
  currency: "PKR",
  timezone: "Asia/Karachi",
  storeStatus: "Active"
};

const DEFAULT_ADMIN = {
  name: "Zain Ahmed",
  email: "admin@techemporium.com.pk",
  phone: "+92 300 9876543",
  avatar: "assets/images/users/admin.jpg"
};

// --- DATA ACCESS LAYERS ---
const db = {
  get(key, fallback) {
    const val = localStorage.getItem(`admin_${key}`);
    return val ? JSON.parse(val) : fallback;
  },
  save(key, data) {
    localStorage.setItem(`admin_${key}`, JSON.stringify(data));
  },
  init() {
    if (!localStorage.getItem("admin_products")) this.save("products", DEFAULT_PRODUCTS);
    if (!localStorage.getItem("admin_categories")) this.save("categories", DEFAULT_CATEGORIES);
    if (!localStorage.getItem("admin_brands")) this.save("brands", DEFAULT_BRANDS);
    if (!localStorage.getItem("admin_orders")) this.save("orders", DEFAULT_ORDERS);
    if (!localStorage.getItem("admin_customers")) this.save("customers", DEFAULT_CUSTOMERS);
    if (!localStorage.getItem("admin_sellers")) this.save("sellers", DEFAULT_SELLERS);
    if (!localStorage.getItem("admin_reviews")) this.save("reviews", DEFAULT_REVIEWS);
    if (!localStorage.getItem("admin_coupons")) this.save("coupons", DEFAULT_COUPONS);
    if (!localStorage.getItem("admin_banners")) this.save("banners", DEFAULT_BANNERS);
    if (!localStorage.getItem("admin_settings")) this.save("settings", DEFAULT_SETTINGS);
    if (!localStorage.getItem("admin_profile")) this.save("profile", DEFAULT_ADMIN);
  }
};

// Initialize DB
db.init();

// --- NOTIFICATION UTILITY ---
const Toast = {
  show(message, type = "success") {
    const container = document.getElementById("toast-container") || (() => {
      const c = document.createElement("div");
      c.id = "toast-container";
      c.className = "position-fixed bottom-0 start-0 p-3";
      c.style.zIndex = "9999";
      document.body.appendChild(c);
      return c;
    })();

    const toast = document.createElement("div");
    toast.className = `alert alert-${type} shadow-lg border-0 d-flex align-items-center gap-2 mb-2`;
    toast.style.background = "rgba(15, 23, 42, 0.95)";
    toast.style.color = "#ffffff";
    toast.style.backdropFilter = "blur(8px)";
    toast.style.borderLeft = `4px solid var(--color-${type === 'success' ? 'success' : (type === 'danger' ? 'danger' : 'warning')})`;
    toast.style.fontSize = "0.875rem";
    toast.style.minWidth = "280px";
    
    let icon = "check-circle-fill text-success";
    if (type === "danger") icon = "x-circle-fill text-danger";
    if (type === "warning") icon = "exclamation-triangle-fill text-warning";

    toast.innerHTML = `
      <i class="bi bi-${icon}"></i>
      <div class="flex-grow-1">${message}</div>
      <button type="button" class="btn-close btn-close-white btn-sm ms-2" onclick="this.parentElement.remove()"></button>
    `;
    container.appendChild(toast);
    setTimeout(() => {
      toast.style.transition = "opacity 0.5s";
      toast.style.opacity = "0";
      setTimeout(() => toast.remove(), 500);
    }, 4000);
  }
};

// --- GLOBAL UI RUNTIME ---
document.addEventListener("DOMContentLoaded", () => {
  // Page Loader Dismissal
  const loader = document.getElementById("loader-wrapper");
  if (loader) {
    setTimeout(() => {
      loader.style.opacity = "0";
      loader.style.visibility = "hidden";
    }, 300);
  }

  // Active Menu Highlight
  const currentPath = window.location.pathname;
  const currentPage = currentPath.substring(currentPath.lastIndexOf('/') + 1) || "dashboard.html";
  
  const menuLinks = document.querySelectorAll(".sidebar-menu .menu-item");
  menuLinks.forEach(link => {
    const href = link.getAttribute("href");
    if (currentPage === href || (currentPage.startsWith("add-") && href.startsWith("products.html")) || (currentPage.startsWith("edit-") && href.startsWith("products.html"))) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });

  // Mobile Sidebar Toggler
  const toggleBtn = document.getElementById("sidebarToggle");
  if (toggleBtn) {
    toggleBtn.addEventListener("click", () => {
      document.body.classList.toggle("sidebar-open");
    });
  }

  // Mobile overlay dismisses sidebar
  const overlay = document.querySelector(".sidebar-overlay");
  if (overlay) {
    overlay.addEventListener("click", () => {
      document.body.classList.remove("sidebar-open");
    });
  }

  // Back to Top Button
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
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // Render mock alerts on forms
  const mockForms = document.querySelectorAll(".needs-mock-validation");
  mockForms.forEach(form => {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      if (form.checkValidity()) {
        Toast.show("Form submitted and simulated successfully!", "success");
        form.reset();
      } else {
        form.classList.add("was-validated");
      }
    });
  });

  // Mock Notifications Badge Center
  const mockAlerts = [
    { title: "New order received!", time: "5 mins ago", icon: "bag-plus", type: "success" },
    { title: "Product ASUS ROG is low in stock!", time: "2 hrs ago", icon: "exclamation-triangle", type: "warning" },
    { title: "New customer signed up", time: "1 day ago", icon: "person-plus", type: "info" }
  ];
  
  const notifIcon = document.querySelector(".action-btn[data-bs-toggle='dropdown']");
  if (notifIcon) {
    const badge = notifIcon.querySelector(".badge-dot");
    if (badge) badge.style.display = "block";
  }
});

// --- HELPER FUNCTION: CURRENCY FORMATTING ---
function formatPKR(num) {
  return "Rs. " + parseInt(num).toLocaleString('en-PK');
}

// --- PAGINATION RENDERING HELPER ---
function renderPagination(totalItems, itemsPerPage, currentPage, targetElementId, onPageChange) {
  const container = document.getElementById(targetElementId);
  if (!container) return;

  const totalPages = Math.ceil(totalItems / itemsPerPage);
  if (totalPages <= 1) {
    container.innerHTML = "";
    return;
  }

  let html = `<ul class="pagination pagination-sm mb-0 justify-content-end">`;
  
  // Previous Button
  html += `
    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
      <a class="page-link" href="#" data-page="${currentPage - 1}"><i class="bi bi-chevron-left"></i></a>
    </li>
  `;

  for (let i = 1; i <= totalPages; i++) {
    html += `
      <li class="page-item ${currentPage === i ? 'active' : ''}">
        <a class="page-link" href="#" data-page="${i}">${i}</a>
      </li>
    `;
  }

  // Next Button
  html += `
    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
      <a class="page-link" href="#" data-page="${currentPage + 1}"><i class="bi bi-chevron-right"></i></a>
    </li>
  `;

  html += `</ul>`;
  container.innerHTML = html;

  container.querySelectorAll(".page-link").forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const pageNum = parseInt(link.getAttribute("data-page"));
      if (pageNum >= 1 && pageNum <= totalPages) {
        onPageChange(pageNum);
      }
    });
  });
}
