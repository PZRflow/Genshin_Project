<?php
namespace Services;

class LogService {
    private const LOG_DIR = __DIR__ . '/../logs/';

    public static function logAction(string $action, string $message): void {
        $logFile = self::getLogFilePath();
        $logMessage = '[' . date('Y-m-d H:i:s') . "] $action: $message" . PHP_EOL;
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }

    private static function getLogFilePath(): string {
        $monthYear = date('m_Y');
        $logFile = self::LOG_DIR . "GENSHIN_{$monthYear}.log";
        if (!file_exists(self::LOG_DIR)) {
            mkdir(self::LOG_DIR, 0777, true);
        }
        return $logFile;
    }

    public static function getAvailableLogFiles(): array {
        $files = [];
        if (file_exists(self::LOG_DIR)) {
            $logFiles = scandir(self::LOG_DIR);
            foreach ($logFiles as $file) {
                // CORRECTION ICI : Remplacer 'MIHOYO_' par 'GENSHIN_'
                if (strpos($file, 'GENSHIN_') === 0) {
                    $files[] = $file;
                }
            }
        }
        return $files;
    }

    public static function getLogContent(string $filename): string {
        $filePath = self::LOG_DIR . $filename;
        return file_exists($filePath) ? file_get_contents($filePath) : "Aucun log trouvé pour ce fichier.";
    }
}
