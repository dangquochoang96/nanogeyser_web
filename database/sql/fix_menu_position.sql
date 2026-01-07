-- Fix URL và vị trí menu

-- =============================================
-- QUAN TRỌNG: Fix URL bị sai (có dấu cách thay vì dấu gạch ngang)
-- =============================================

-- Fix URL "Giải pháp lọc tổng"
UPDATE menu SET url = '/giai-phap-loc-tong' WHERE name LIKE '%lọc tổng%' OR name LIKE '%Lọc Tổng%' OR url LIKE '%giai phap loc tong%';

-- Fix URL "Giải pháp thay lõi lọc"  
UPDATE menu SET url = '/giai-phap-thay-loi-loc' WHERE name LIKE '%thay lõi%' OR name LIKE '%Thay Lõi%' OR url LIKE '%giai phap thay loi loc%';

-- =============================================
-- Di chuyển vào dropdown "Giải pháp lọc nước"
-- =============================================

UPDATE menu 
SET parent_id = (SELECT id FROM (SELECT id FROM menu WHERE name LIKE '%Giải pháp lọc nước%' LIMIT 1) AS tmp)
WHERE url = '/giai-phap-loc-tong';

UPDATE menu 
SET parent_id = (SELECT id FROM (SELECT id FROM menu WHERE name LIKE '%Giải pháp lọc nước%' LIMIT 1) AS tmp)
WHERE url = '/giai-phap-thay-loi-loc';

-- =============================================
-- Cập nhật thứ tự hiển thị
-- =============================================
UPDATE menu SET `order` = 1 WHERE url = '/giai-phap-loc-tong';
UPDATE menu SET `order` = 2 WHERE url = '/giai-phap-thay-loi-loc';
UPDATE menu SET `order` = 3 WHERE url LIKE '%giai-phap-phong-bep%';
UPDATE menu SET `order` = 4 WHERE url LIKE '%giai-phap-phong-khach%';
UPDATE menu SET `order` = 5 WHERE url LIKE '%giai-phap-cao-cap%';
UPDATE menu SET `order` = 6 WHERE url LIKE '%giai-phap-combo%';

-- Kiểm tra kết quả
SELECT id, name, url, parent_id, `order` FROM menu ORDER BY parent_id, `order`;
