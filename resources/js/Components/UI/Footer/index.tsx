import { Link } from '@inertiajs/react';
import { HTMLAttributes } from 'react';

const Footer = ({
    className = '',
    ...props
}: HTMLAttributes<HTMLDivElement>) => {
    return (
        <footer
            {...props}
            className={`flex justify-between bg-dark px-24 py-8 text-white ${className}`}
        >
            <div className="space-y-0.5">
                <small>
                    &copy; 2024 Corporate Social Reponsibility Kabupaten Cirebon
                </small>
                <p>
                    Pemkab Kabupaten Cirebon, Badan Pendapatan Daerah (Bapenda)
                    Kabupaten Cirebon.
                </p>
            </div>
            <Link href="">Kembali ke Halaman Utama</Link>
        </footer>
    );
};

export default Footer;
