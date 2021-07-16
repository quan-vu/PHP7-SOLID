<?php

class User  {};

/**
 * Bad code
 * This is non-SOLID principle
 * 
 * Look inside this UserService class
 * It class thực hiện rất nhiều trách nhiệm/ nhiệm vụ khác nhau:
 * - Lấy dữ liệu từ DB
 * - Validate
 * - Thông báo
 * - Ghi log
 * - Xử lý dữ liệu
 * ...
 * 
 * Khi chỉ cần ta thay đổi cách lấy dữ liệu DB, thay đổi cách validate, … ta sẽ phải sửa đổi class này, 
 * càng về sau class sẽ càng phình to ra. 
 * Rất khó khăn khi maintain, upgrade, fix bug, test, …
 */
class UserService {

    // Get data from database
    public function getUser(): User {
        return null;
    }

    // Check validation
    public function isValid(): bool {
        return true;
    }

    // Show Notification
    public function showNotification(): string {
        return "Notify to user";
    }

    // Logging
    public function logging() {
        // write to app.log
    }

    // Parsing
    public function parseJson(string $jsonStr): User {
        return null;
    }
}

/**
 * Theo đúng nguyên tắc: Single Responsibility, 
 * - Ta phải tách class này ra làm nhiều class riêng, 
 * - Mỗi class chỉ làm một nhiệm vụ duy nhất. 
 * 
 * Tuy số lượng class nhiều hơn nhưng việc 
 * - Sửa chữa sẽ đơn giản hơn, 
 * - Dễ dàng tái sử dụng hơn, 
 * - class ngắn hơn nên cũng ít bug hơn.
 * 
 * Chẳng hạn, với chương trình trên chúng ta có thể tách thành các class: 
 * - UserRepository, 
 * - UserValidator, 
 * - SystemLogger, 
 * - JsonConverter, ….
 * 
 * Một số ví dụ về SRP cần xem xét có thể cần được tách riêng bao gồm: 
 * - Persistence, Validation, Notification, 
 * - Error Handling, Logging, Class Instantiation, 
 * - Formatting, Parsing, Mapping, …
 */
