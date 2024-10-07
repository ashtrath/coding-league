import { Link } from '@inertiajs/react';
import { HTMLAttributes } from 'react';
import Button from '../Button';

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
            <Button
                variant="secondary"
                asChild
                className="bg-transparent text-white hover:bg-white hover:text-dark"
            >
                <Link href="/">Kembali Ke Halaman Utama</Link>
            </Button>
        </footer>
    );
};

export default Footer;
